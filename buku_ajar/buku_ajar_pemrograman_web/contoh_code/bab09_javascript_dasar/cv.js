/**
 * Memuat data CV lalu mengisi elemen di halaman.
 * Urutan: (1) fetch("cv-data.json") jika di http(s) / server lokal;
 * (2) elemen <script type="application/json" id="cv-data-embedded"> di cv.html
 * agar tetap jalan saat membuka file:// (fetch ke berkas .json biasanya diblokir).
 */

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

function renderNav(ol, items) {
    ol.replaceChildren();
    items.forEach(function (item) {
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + item.hash;
        a.textContent = item.label;
        li.appendChild(a);
        ol.appendChild(li);
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

function showLoadError(message) {
    const main = document.querySelector(".cv-konten main");
    if (!main) return;
    const div = document.createElement("div");
    div.setAttribute("role", "alert");
    div.style.cssText =
        "background:#fef2f2;border:1px solid #fecaca;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1rem;";
    div.textContent = message;
    main.insertBefore(div, main.firstChild);
}

async function loadCvData() {
    try {
        const res = await fetch("cv-data.json", { cache: "no-store" });
        if (res.ok) return await res.json();
    } catch (_) {
        /* file://, offline, atau CORS */
    }
    const embedded = document.getElementById("cv-data-embedded");
    if (embedded && embedded.textContent.trim()) {
        return JSON.parse(embedded.textContent);
    }
    throw new Error("Tidak ada sumber data (cv-data.json atau #cv-data-embedded).");
}

async function loadCv() {
    let data;
    try {
        data = await loadCvData();
    } catch (e) {
        showLoadError(
            "Tidak dapat memuat data CV. Pastikan berkas cv-data.json ada di folder yang sama, atau sisipkan data di elemen #cv-data-embedded pada cv.html."
        );
        return;
    }

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

document.addEventListener("DOMContentLoaded", loadCv);
