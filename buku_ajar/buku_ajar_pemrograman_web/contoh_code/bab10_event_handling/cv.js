/**
 * CV: render dari objek data, muat awal dari localStorage (jika valid) atau JSON (cv-data.json lalu GitHub).
 * Penyimpanan lokal: CV_LOCAL_STORAGE_KEY. Edit per bagian: tombol Edit → JSON potongan → Simpan.
 */
const CV_JSON_URL =
    "https://raw.githubusercontent.com/cecepsuwanda/kuliah_pemrograman_internet/versi1/buku_ajar/buku_ajar_pemrograman_web/contoh_code/bab10_event_handling/cv-data.json";

/** Kunci penyimpanan data CV di localStorage (bab 10). */
const CV_LOCAL_STORAGE_KEY = "bab10_cv_data";

/** Kartu konten yang punya editor JSON tersendiri (id section = kunci di objek CV). */
const CV_SECTION_KEYS = [
    "ringkasan",
    "keterampilan",
    "pengalaman",
    "pendidikan",
    "portofolio",
    "sertifikasi",
    "organisasi",
    "kontak",
];

/** Objek CV penuh di memori; disinkronkan ke localStorage setelah simpan / muat. */
let appCvData = null;

function setText(id, text) {
    const el = document.getElementById(id);
    if (el) el.textContent = text;
}

function appendText(parent, text) {
    parent.appendChild(document.createTextNode(text));
}

function renderAddress(container, person) {
    container.replaceChildren();

    const lineEmail = document.createElement("span");
    appendText(lineEmail, "Email: ");
    const aMail = document.createElement("a");
    aMail.href = "mailto:" + person.email;
    aMail.textContent = person.email;
    lineEmail.appendChild(aMail);
    container.appendChild(lineEmail);
    container.appendChild(document.createElement("br"));

    const linePhone = document.createElement("span");
    appendText(linePhone, "Telepon: ");
    const aTel = document.createElement("a");
    aTel.href = "tel:" + person.phoneE164.replace(/\s/g, "");
    aTel.textContent = person.phoneDisplay;
    linePhone.appendChild(aTel);
    container.appendChild(linePhone);
    container.appendChild(document.createElement("br"));

    const lineWeb = document.createElement("span");
    appendText(lineWeb, "Situs: ");
    const aWeb = document.createElement("a");
    aWeb.href = person.website;
    aWeb.textContent = person.website;
    lineWeb.appendChild(aWeb);
    container.appendChild(lineWeb);
    container.appendChild(document.createElement("br"));

    const lineAddr = document.createElement("span");
    appendText(lineAddr, "Alamat: " + person.address);
    container.appendChild(lineAddr);
}

function renderNav(navUl, items) {
    navUl.replaceChildren();
    items.forEach(function (item) {
        const li = document.createElement("li");
        li.className = "nav-item";
        const a = document.createElement("a");
        a.className = "nav-link";
        a.href = "#" + item.hash;
        a.textContent = item.label;
        li.appendChild(a);
        navUl.appendChild(li);
    });
}

function renderPeriodeCell(td, segments) {
    td.replaceChildren();
    segments.forEach(function (seg) {
        if (seg.type === "time") {
            const t = document.createElement("time");
            if (seg.datetime) t.dateTime = seg.datetime;
            t.textContent = seg.label;
            td.appendChild(t);
        } else {
            appendText(td, seg.value);
        }
    });
}

function renderSkills(dl, data) {
    dl.replaceChildren();
    data.items.forEach(function (item) {
        const dt = document.createElement("dt");
        dt.textContent = item.judul;
        const dd = document.createElement("dd");
        dd.textContent = item.deskripsi;
        dl.appendChild(dt);
        dl.appendChild(dd);
    });
}

function renderExperience(container, data) {
    container.replaceChildren();
    data.items.forEach(function (item, i) {
        const art = document.createElement("article");
        const hid = "judul-pengalaman-" + (i + 1);
        art.setAttribute("aria-labelledby", hid);

        const h3 = document.createElement("h3");
        h3.id = hid;
        h3.textContent = item.judul;
        art.appendChild(h3);

        const p = document.createElement("p");
        const t1 = document.createElement("time");
        t1.dateTime = item.mulai.datetime;
        t1.textContent = item.mulai.label;
        p.appendChild(t1);
        appendText(p, " – ");
        const t2 = document.createElement("time");
        t2.dateTime = item.selesai.datetime;
        t2.textContent = item.selesai.label;
        p.appendChild(t2);
        art.appendChild(p);

        const ul = document.createElement("ul");
        item.poin.forEach(function (teks) {
            const li = document.createElement("li");
            li.textContent = teks;
            ul.appendChild(li);
        });
        art.appendChild(ul);

        if (i < data.items.length - 1) {
            art.className = "border-bottom pb-3 mb-3";
        }
        container.appendChild(art);
    });
}

function renderEducation(tbody, captionEl, data) {
    captionEl.textContent = data.caption;
    tbody.replaceChildren();
    data.rows.forEach(function (row) {
        const tr = document.createElement("tr");
        ["jenjang", "institusi", "program"].forEach(function (key) {
            const td = document.createElement("td");
            td.textContent = row[key];
            tr.appendChild(td);
        });
        const tdPer = document.createElement("td");
        renderPeriodeCell(tdPer, row.periodeSegments);
        tr.appendChild(tdPer);
        tbody.appendChild(tr);
    });
}

function renderPortfolio(ul, data) {
    ul.replaceChildren();
    data.items.forEach(function (item) {
        const li = document.createElement("li");
        const strong = document.createElement("strong");
        strong.textContent = item.judul;
        li.appendChild(strong);
        li.appendChild(document.createElement("br"));
        const a = document.createElement("a");
        a.href = item.linkHref;
        a.textContent = item.linkText;
        li.appendChild(a);
        ul.appendChild(li);
    });
}

function renderSertifikasi(ul, data) {
    ul.replaceChildren();
    data.items.forEach(function (item) {
        const li = document.createElement("li");
        appendText(li, item.nama + " — ");
        const t = document.createElement("time");
        t.dateTime = item.datetime;
        t.textContent = item.tahun;
        li.appendChild(t);
        ul.appendChild(li);
    });
}

function renderOrganisasi(ul, data) {
    ul.replaceChildren();
    data.items.forEach(function (item) {
        const li = document.createElement("li");
        appendText(li, item.teks + " ");
        item.periodeSegments.forEach(function (seg) {
            if (seg.type === "time") {
                const t = document.createElement("time");
                t.dateTime = seg.datetime;
                t.textContent = seg.label;
                li.appendChild(t);
            } else {
                appendText(li, seg.value);
            }
        });
        ul.appendChild(li);
    });
}

function renderKontak(p, person, data) {
    p.replaceChildren();
    appendText(p, data.intro + " ");
    const a = document.createElement("a");
    a.href = "mailto:" + person.email;
    a.textContent = person.email;
    p.appendChild(a);
    appendText(p, ".");
}

function renderFooter(p, data) {
    p.replaceChildren();
    appendText(p, "\u00a9 ");
    const y = document.createElement("time");
    y.dateTime = String(data.year);
    y.textContent = String(data.year);
    p.appendChild(y);
    appendText(p, " " + data.text + " ");
    const code = document.createElement("code");
    code.textContent = "cv-data.json";
    p.appendChild(code);
    appendText(p, " + ");
    const c2 = document.createElement("code");
    c2.textContent = "cv.js";
    p.appendChild(c2);
    appendText(p, ".");
}

function isValidCvData(obj) {
    return (
        obj !== null &&
        typeof obj === "object" &&
        typeof obj.documentTitle === "string" &&
        obj.person !== null &&
        typeof obj.person === "object" &&
        typeof obj.person.name === "string"
    );
}

function readCvFromLocalStorage() {
    try {
        const raw = localStorage.getItem(CV_LOCAL_STORAGE_KEY);
        if (!raw || !raw.trim()) return null;
        const data = JSON.parse(raw);
        return isValidCvData(data) ? data : null;
    } catch (_) {
        return null;
    }
}

function writeCvToLocalStorage(data) {
    localStorage.setItem(CV_LOCAL_STORAGE_KEY, JSON.stringify(data));
}

function clearCvLocalStorage() {
    localStorage.removeItem(CV_LOCAL_STORAGE_KEY);
}

function dismissLoadError() {
    const el = document.getElementById("cv-load-error");
    if (!el) return;
    el.textContent = "";
    el.classList.add("d-none");
}

function showLoadError(message) {
    const el = document.getElementById("cv-load-error");
    if (!el) return;
    el.textContent = message;
    el.classList.remove("d-none");
}

function setJsonFeedback(kind, message) {
    const el = document.getElementById("cv-json-feedback");
    if (!el) return;
    if (!message) {
        el.textContent = "";
        el.className = "alert d-none mb-3";
        el.setAttribute("role", "status");
        return;
    }
    el.textContent = message;
    el.className = "alert mb-3 alert-" + (kind === "success" ? "success" : "danger");
    el.setAttribute("role", kind === "success" ? "status" : "alert");
}

function validateSectionSlice(sectionKey, obj) {
    if (obj === null || typeof obj !== "object") {
        return "Data harus berupa objek JSON.";
    }
    if (sectionKey === "ringkasan") {
        if (typeof obj.heading !== "string" || typeof obj.text !== "string") {
            return "ringkasan: properti heading dan text wajib berupa string.";
        }
        return null;
    }
    if (sectionKey === "keterampilan") {
        if (typeof obj.heading !== "string" || !Array.isArray(obj.items)) {
            return "keterampilan: heading (string) dan items (array) wajib ada.";
        }
        return null;
    }
    if (sectionKey === "pengalaman") {
        if (typeof obj.heading !== "string" || !Array.isArray(obj.items)) {
            return "pengalaman: heading (string) dan items (array) wajib ada.";
        }
        for (var i = 0; i < obj.items.length; i++) {
            var it = obj.items[i];
            if (!it || typeof it.judul !== "string") {
                return "pengalaman.items[" + i + "]: judul wajib string.";
            }
            if (!it.mulai || typeof it.mulai.datetime !== "string" || typeof it.mulai.label !== "string") {
                return "pengalaman.items[" + i + "]: mulai.datetime dan mulai.label wajib string.";
            }
            if (!it.selesai || typeof it.selesai.datetime !== "string" || typeof it.selesai.label !== "string") {
                return "pengalaman.items[" + i + "]: selesai.datetime dan selesai.label wajib string.";
            }
            if (!Array.isArray(it.poin)) {
                return "pengalaman.items[" + i + "]: poin wajib array.";
            }
        }
        return null;
    }
    if (sectionKey === "pendidikan") {
        if (typeof obj.heading !== "string" || typeof obj.caption !== "string" || !Array.isArray(obj.rows)) {
            return "pendidikan: heading, caption (string), dan rows (array) wajib ada.";
        }
        return null;
    }
    if (sectionKey === "portofolio" || sectionKey === "sertifikasi" || sectionKey === "organisasi") {
        if (typeof obj.heading !== "string" || !Array.isArray(obj.items)) {
            return sectionKey + ": heading (string) dan items (array) wajib ada.";
        }
        return null;
    }
    if (sectionKey === "kontak") {
        if (typeof obj.heading !== "string" || typeof obj.intro !== "string") {
            return "kontak: heading dan intro wajib string.";
        }
        return null;
    }
    return "Bagian tidak dikenal.";
}

function hideSectionEditFeedback(sectionKey) {
    var root = document.getElementById(sectionKey);
    if (!root) return;
    var fb = root.querySelector(".cv-section-editor .cv-section-edit-feedback");
    if (!fb) return;
    fb.textContent = "";
    fb.className = "cv-section-edit-feedback alert d-none py-2 px-3 small mb-2";
    fb.setAttribute("role", "alert");
}

function setSectionEditFeedback(sectionKey, kind, message) {
    var root = document.getElementById(sectionKey);
    if (!root) return;
    var fb = root.querySelector(".cv-section-editor .cv-section-edit-feedback");
    if (!fb) return;
    if (!message) {
        hideSectionEditFeedback(sectionKey);
        return;
    }
    fb.textContent = message;
    fb.className =
        "cv-section-edit-feedback alert py-2 px-3 small mb-2 alert-" + (kind === "success" ? "success" : "danger");
    fb.setAttribute("role", kind === "success" ? "status" : "alert");
    fb.classList.remove("d-none");
}

function closeSectionEditorUI(sectionKey) {
    var root = document.getElementById(sectionKey);
    if (!root) return;
    var view = root.querySelector(".cv-section-view");
    var editor = root.querySelector(".cv-section-editor");
    if (!view || !editor) return;
    view.classList.remove("d-none");
    editor.classList.add("d-none");
    editor.setAttribute("aria-hidden", "true");
    hideSectionEditFeedback(sectionKey);
}

function closeAllSectionEditors() {
    CV_SECTION_KEYS.forEach(closeSectionEditorUI);
}

function openSectionEditor(sectionKey) {
    if (!appCvData || !appCvData[sectionKey]) return;
    closeAllSectionEditors();
    var root = document.getElementById(sectionKey);
    if (!root) return;
    var view = root.querySelector(".cv-section-view");
    var editor = root.querySelector(".cv-section-editor");
    var ta = root.querySelector("textarea.cv-section-json");
    if (!view || !editor || !ta) return;
    ta.value = JSON.stringify(appCvData[sectionKey], null, 2);
    view.classList.add("d-none");
    editor.classList.remove("d-none");
    editor.setAttribute("aria-hidden", "false");
    hideSectionEditFeedback(sectionKey);
}

function wireMainSectionDelegation() {
    var main = document.getElementById("cv-main");
    if (!main) return;
    main.addEventListener("click", function (ev) {
        var btn = ev.target.closest("[data-cv-action][data-cv-section]");
        if (!btn) return;
        var action = btn.getAttribute("data-cv-action");
        var sectionKey = btn.getAttribute("data-cv-section");
        if (!sectionKey || CV_SECTION_KEYS.indexOf(sectionKey) === -1) return;

        if (action === "edit") {
            openSectionEditor(sectionKey);
            return;
        }
        if (action === "cancel") {
            closeSectionEditorUI(sectionKey);
            return;
        }
        if (action !== "save") return;

        var root = document.getElementById(sectionKey);
        var ta = root ? root.querySelector("textarea.cv-section-json") : null;
        if (!ta) return;

        var parsed;
        try {
            parsed = JSON.parse(ta.value);
        } catch (e) {
            setSectionEditFeedback(
                sectionKey,
                "error",
                "JSON tidak valid: " + (e && e.message ? e.message : String(e))
            );
            return;
        }

        var err = validateSectionSlice(sectionKey, parsed);
        if (err) {
            setSectionEditFeedback(sectionKey, "error", err);
            return;
        }

        appCvData[sectionKey] = parsed;
        writeCvToLocalStorage(appCvData);
        dismissLoadError();
        setJsonFeedback("success", "Bagian \"" + sectionKey + "\" tersimpan ke localStorage.");
        renderCv(appCvData);
        closeSectionEditorUI(sectionKey);
    });
}

async function loadCvData() {
    try {
        const resLocal = await fetch("cv-data.json", { cache: "no-store" });
        if (resLocal.ok) return await resLocal.json();
    } catch (_) {
        /* file:// atau jaringan */
    }
    const res = await fetch(CV_JSON_URL, { cache: "no-store" });
    if (!res.ok) {
        throw new Error("HTTP " + res.status + " saat mengambil " + CV_JSON_URL);
    }
    return await res.json();
}

function renderCv(data) {
    document.title = data.documentTitle;
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) metaDesc.setAttribute("content", data.metaDescription);

    const p = data.person;
    setText("cv-name", p.name);
    setText("cv-role", p.role);
    setText("cv-location", p.location);
    renderAddress(document.getElementById("cv-address"), p);

    renderNav(document.getElementById("cv-nav-list"), data.navItems);

    setText("judul-ringkasan", data.ringkasan.heading);
    setText("cv-ringkasan-text", data.ringkasan.text);

    setText("judul-keterampilan", data.keterampilan.heading);
    renderSkills(document.getElementById("cv-skills"), data.keterampilan);

    setText("judul-pengalaman", data.pengalaman.heading);
    renderExperience(document.getElementById("cv-experience"), data.pengalaman);

    setText("judul-pendidikan", data.pendidikan.heading);
    renderEducation(
        document.getElementById("cv-education-body"),
        document.getElementById("cv-education-caption"),
        data.pendidikan
    );

    setText("judul-portofolio", data.portofolio.heading);
    renderPortfolio(document.getElementById("cv-portfolio-list"), data.portofolio);

    setText("judul-sertifikasi", data.sertifikasi.heading);
    renderSertifikasi(document.getElementById("cv-sertifikasi-list"), data.sertifikasi);

    setText("judul-organisasi", data.organisasi.heading);
    renderOrganisasi(document.getElementById("cv-organisasi-list"), data.organisasi);

    setText("judul-kontak", data.kontak.heading);
    renderKontak(document.getElementById("cv-kontak-text"), p, data.kontak);

    renderFooter(document.getElementById("cv-footer-text"), data.footer);
}

async function fetchAndPersistCv() {
    closeAllSectionEditors();
    const data = await loadCvData();
    appCvData = data;
    writeCvToLocalStorage(appCvData);
    dismissLoadError();
    setJsonFeedback("", "");
    renderCv(appCvData);
}

function wireStoragePanel() {
    document.getElementById("cv-btn-reload-json").addEventListener("click", function () {
        setJsonFeedback("", "");
        dismissLoadError();
        fetchAndPersistCv().catch(function () {
            showLoadError(
                "Tidak dapat memuat data CV dari jaringan (periksa koneksi dan URL di cv.js)."
            );
        });
    });

    document.getElementById("cv-btn-clear-ls").addEventListener("click", function () {
        setJsonFeedback("", "");
        dismissLoadError();
        closeAllSectionEditors();
        clearCvLocalStorage();
        fetchAndPersistCv().catch(function () {
            showLoadError(
                "Penyimpanan lokal dihapus tetapi data tidak dapat dimuat ulang dari jaringan."
            );
        });
    });
}

async function initCv() {
    dismissLoadError();
    setJsonFeedback("", "");
    wireStoragePanel();
    wireMainSectionDelegation();

    const fromLs = readCvFromLocalStorage();
    if (fromLs) {
        appCvData = fromLs;
        renderCv(appCvData);
        return;
    }

    try {
        await fetchAndPersistCv();
    } catch (e) {
        appCvData = null;
        showLoadError(
            "Tidak dapat memuat data CV (periksa koneksi, cv-data.json di folder yang sama, atau URL di cv.js)."
        );
    }
}

document.addEventListener("DOMContentLoaded", initCv);
