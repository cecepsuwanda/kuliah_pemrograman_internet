/**
 * CV Bab 11: render dari objek data dengan jQuery + layout AdminLTE 3.
 * Muat awal dari localStorage (jika valid) atau JSON (cv-data.json lalu GitHub).
 */
(function ($) {
    "use strict";

    var CV_JSON_URL =
        "https://raw.githubusercontent.com/cecepsuwanda/kuliah_pemrograman_internet/versi1/buku_ajar/buku_ajar_pemrograman_web/contoh_code/bab11_frontend_lib/cv-data.json";

    var CV_LOCAL_STORAGE_KEY = "bab11_cv_data";

    var CV_SECTION_KEYS = [
        "ringkasan",
        "keterampilan",
        "pengalaman",
        "pendidikan",
        "portofolio",
        "sertifikasi",
        "organisasi",
        "kontak",
    ];

    var appCvData = null;

    function setText(id, text) {
        $("#" + id).text(text);
    }

    function renderAddress($container, person) {
        $container.empty();
        $container
            .append(
                $("<span>").text("Email: ").append(
                    $("<a>").attr("href", "mailto:" + person.email).text(person.email)
                ),
                $("<br>"),
                $("<span>").text("Telepon: ").append(
                    $("<a>")
                        .attr("href", "tel:" + person.phoneE164.replace(/\s/g, ""))
                        .text(person.phoneDisplay)
                ),
                $("<br>"),
                $("<span>").text("Situs: ").append(
                    $("<a>").attr("href", person.website).text(person.website)
                ),
                $("<br>"),
                $("<span>").text("Alamat: " + person.address)
            );
    }

    function renderNav($navUl, items) {
        $navUl.empty();
        $.each(items, function (_, item) {
            $navUl.append(
                $("<li>", { class: "nav-item" }).append(
                    $("<a>", {
                        class: "nav-link",
                        href: "#" + item.hash,
                        text: item.label,
                    })
                )
            );
        });
    }

    function renderPeriodeCell($td, segments) {
        $td.empty();
        $.each(segments, function (_, seg) {
            if (seg.type === "time") {
                var $t = $("<time>").text(seg.label);
                if (seg.datetime) {
                    $t.attr("datetime", seg.datetime);
                }
                $td.append($t);
            } else {
                $td.append(document.createTextNode(seg.value));
            }
        });
    }

    function renderSkills($dl, data) {
        $dl.empty();
        $.each(data.items, function (_, item) {
            $dl.append($("<dt>").text(item.judul), $("<dd>").text(item.deskripsi));
        });
    }

    function renderExperience($container, data) {
        $container.empty();
        $.each(data.items, function (i, item) {
            var hid = "judul-pengalaman-" + (i + 1);
            var $art = $("<article>", { "aria-labelledby": hid });
            var $h3 = $("<h3>", { id: hid, text: item.judul });
            var $p = $("<p>").append(
                $("<time>").attr("datetime", item.mulai.datetime).text(item.mulai.label),
                document.createTextNode(" – "),
                $("<time>").attr("datetime", item.selesai.datetime).text(item.selesai.label)
            );
            var $ul = $("<ul>");
            $.each(item.poin, function (_, teks) {
                $ul.append($("<li>").text(teks));
            });
            $art.append($h3, $p, $ul);
            if (i < data.items.length - 1) {
                $art.addClass("border-bottom pb-3 mb-3");
            }
            $container.append($art);
        });
    }

    function renderEducation($tbody, $captionEl, data) {
        $captionEl.text(data.caption);
        $tbody.empty();
        $.each(data.rows, function (_, row) {
            var $tr = $("<tr>");
            $.each(["jenjang", "institusi", "program"], function (_, key) {
                $tr.append($("<td>").text(row[key]));
            });
            var $tdPer = $("<td>");
            renderPeriodeCell($tdPer, row.periodeSegments);
            $tr.append($tdPer);
            $tbody.append($tr);
        });
    }

    function renderPortfolio($ul, data) {
        $ul.empty();
        $.each(data.items, function (_, item) {
            $ul.append(
                $("<li>").append(
                    $("<strong>").text(item.judul),
                    $("<br>"),
                    $("<a>").attr("href", item.linkHref).text(item.linkText)
                )
            );
        });
    }

    function renderSertifikasi($ul, data) {
        $ul.empty();
        $.each(data.items, function (_, item) {
            $ul.append(
                $("<li>")
                    .append(document.createTextNode(item.nama + " — "))
                    .append($("<time>").attr("datetime", item.datetime).text(item.tahun))
            );
        });
    }

    function renderOrganisasi($ul, data) {
        $ul.empty();
        $.each(data.items, function (_, item) {
            var $li = $("<li>").append(document.createTextNode(item.teks + " "));
            $.each(item.periodeSegments, function (_, seg) {
                if (seg.type === "time") {
                    $li.append($("<time>").attr("datetime", seg.datetime).text(seg.label));
                } else {
                    $li.append(document.createTextNode(seg.value));
                }
            });
            $ul.append($li);
        });
    }

    function renderKontak($p, person, data) {
        $p.empty().append(
            document.createTextNode(data.intro + " "),
            $("<a>").attr("href", "mailto:" + person.email).text(person.email),
            document.createTextNode(".")
        );
    }

    function renderFooter($p, data) {
        $p.empty().append(
            document.createTextNode("\u00a9 "),
            $("<time>").attr("datetime", String(data.year)).text(String(data.year)),
            document.createTextNode(" " + data.text + " "),
            $("<code>").text("cv-data.json"),
            document.createTextNode(" + "),
            $("<code>").text("cv.js"),
            document.createTextNode(" (jQuery).")
        );
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
            var raw = localStorage.getItem(CV_LOCAL_STORAGE_KEY);
            if (!raw || !$.trim(raw)) {
                return null;
            }
            var data = JSON.parse(raw);
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
        $("#cv-load-error").text("").addClass("d-none");
    }

    function showLoadError(message) {
        $("#cv-load-error").text(message).removeClass("d-none");
    }

    function setJsonFeedback(kind, message) {
        var $el = $("#cv-json-feedback");
        if (!message) {
            $el.text("").attr({ class: "alert d-none mb-3", role: "status" });
            return;
        }
        $el
            .text(message)
            .attr({
                class: "alert mb-3 alert-" + (kind === "success" ? "success" : "danger"),
                role: kind === "success" ? "status" : "alert",
            });
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
            if (typeof obj.heading !== "string" || !$.isArray(obj.items)) {
                return "keterampilan: heading (string) dan items (array) wajib ada.";
            }
            return null;
        }
        if (sectionKey === "pengalaman") {
            if (typeof obj.heading !== "string" || !$.isArray(obj.items)) {
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
                if (!$.isArray(it.poin)) {
                    return "pengalaman.items[" + i + "]: poin wajib array.";
                }
            }
            return null;
        }
        if (sectionKey === "pendidikan") {
            if (typeof obj.heading !== "string" || typeof obj.caption !== "string" || !$.isArray(obj.rows)) {
                return "pendidikan: heading, caption (string), dan rows (array) wajib ada.";
            }
            return null;
        }
        if (sectionKey === "portofolio" || sectionKey === "sertifikasi" || sectionKey === "organisasi") {
            if (typeof obj.heading !== "string" || !$.isArray(obj.items)) {
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
        var $fb = $("#" + sectionKey)
            .find(".cv-section-editor .cv-section-edit-feedback")
            .first();
        $fb.text("").attr({
            class: "cv-section-edit-feedback alert d-none py-2 px-3 small mb-2",
            role: "alert",
        });
    }

    function setSectionEditFeedback(sectionKey, kind, message) {
        var $fb = $("#" + sectionKey)
            .find(".cv-section-editor .cv-section-edit-feedback")
            .first();
        if (!message) {
            hideSectionEditFeedback(sectionKey);
            return;
        }
        $fb
            .text(message)
            .attr({
                class:
                    "cv-section-edit-feedback alert py-2 px-3 small mb-2 alert-" +
                    (kind === "success" ? "success" : "danger"),
                role: kind === "success" ? "status" : "alert",
            })
            .removeClass("d-none");
    }

    function closeSectionEditorUI(sectionKey) {
        var $root = $("#" + sectionKey);
        $root.find(".cv-section-view").removeClass("d-none");
        $root.find(".cv-section-editor").addClass("d-none").attr("aria-hidden", "true");
        hideSectionEditFeedback(sectionKey);
    }

    function closeAllSectionEditors() {
        $.each(CV_SECTION_KEYS, function (_, key) {
            closeSectionEditorUI(key);
        });
    }

    function openSectionEditor(sectionKey) {
        if (!appCvData || !appCvData[sectionKey]) {
            return;
        }
        closeAllSectionEditors();
        var $root = $("#" + sectionKey);
        var $ta = $root.find("textarea.cv-section-json").first();
        if (!$ta.length) {
            return;
        }
        $ta.val(JSON.stringify(appCvData[sectionKey], null, 2));
        $root.find(".cv-section-view").addClass("d-none");
        $root.find(".cv-section-editor").removeClass("d-none").attr("aria-hidden", "false");
        hideSectionEditFeedback(sectionKey);
    }

    function wireMainSectionDelegation() {
        $("#cv-main").on("click", "[data-cv-action][data-cv-section]", function () {
            var $btn = $(this);
            var action = $btn.attr("data-cv-action");
            var sectionKey = $btn.attr("data-cv-section");
            if (!sectionKey || $.inArray(sectionKey, CV_SECTION_KEYS) === -1) {
                return;
            }

            if (action === "edit") {
                openSectionEditor(sectionKey);
                return;
            }
            if (action === "cancel") {
                closeSectionEditorUI(sectionKey);
                return;
            }
            if (action !== "save") {
                return;
            }

            var $ta = $("#" + sectionKey).find("textarea.cv-section-json").first();
            if (!$ta.length) {
                return;
            }

            var parsed;
            try {
                parsed = JSON.parse($ta.val());
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
            setJsonFeedback("success", 'Bagian "' + sectionKey + '" tersimpan ke localStorage.');
            renderCv(appCvData);
            closeSectionEditorUI(sectionKey);
        });
    }

    function loadCvData() {
        var deferred = $.Deferred();
        $.ajax({ url: "cv-data.json", dataType: "json", cache: false })
            .done(function (data) {
                deferred.resolve(data);
            })
            .fail(function () {
                $.ajax({ url: CV_JSON_URL, dataType: "json", cache: false })
                    .done(function (data) {
                        deferred.resolve(data);
                    })
                    .fail(function (xhr) {
                        deferred.reject(
                            new Error("HTTP " + xhr.status + " saat mengambil " + CV_JSON_URL)
                        );
                    });
            });
        return deferred.promise();
    }

    function renderCv(data) {
        document.title = data.documentTitle;
        $('meta[name="description"]').attr("content", data.metaDescription);

        var p = data.person;
        setText("cv-name", p.name);
        setText("cv-role", p.role);
        setText("cv-location", p.location);
        renderAddress($("#cv-address"), p);

        renderNav($("#cv-nav-list"), data.navItems);

        setText("judul-ringkasan", data.ringkasan.heading);
        setText("cv-ringkasan-text", data.ringkasan.text);

        setText("judul-keterampilan", data.keterampilan.heading);
        renderSkills($("#cv-skills"), data.keterampilan);

        setText("judul-pengalaman", data.pengalaman.heading);
        renderExperience($("#cv-experience"), data.pengalaman);

        setText("judul-pendidikan", data.pendidikan.heading);
        renderEducation($("#cv-education-body"), $("#cv-education-caption"), data.pendidikan);

        setText("judul-portofolio", data.portofolio.heading);
        renderPortfolio($("#cv-portfolio-list"), data.portofolio);

        setText("judul-sertifikasi", data.sertifikasi.heading);
        renderSertifikasi($("#cv-sertifikasi-list"), data.sertifikasi);

        setText("judul-organisasi", data.organisasi.heading);
        renderOrganisasi($("#cv-organisasi-list"), data.organisasi);

        setText("judul-kontak", data.kontak.heading);
        renderKontak($("#cv-kontak-text"), p, data.kontak);

        renderFooter($("#cv-footer-text"), data.footer);
    }

    function fetchAndPersistCv() {
        closeAllSectionEditors();
        return loadCvData().then(function (data) {
            appCvData = data;
            writeCvToLocalStorage(appCvData);
            dismissLoadError();
            setJsonFeedback("", "");
            renderCv(appCvData);
        });
    }

    function wireStoragePanel() {
        $("#cv-btn-reload-json").on("click", function () {
            setJsonFeedback("", "");
            dismissLoadError();
            fetchAndPersistCv().fail(function () {
                showLoadError(
                    "Tidak dapat memuat data CV dari jaringan (periksa koneksi dan URL di cv.js)."
                );
            });
        });

        $("#cv-btn-clear-ls").on("click", function () {
            setJsonFeedback("", "");
            dismissLoadError();
            closeAllSectionEditors();
            clearCvLocalStorage();
            fetchAndPersistCv().fail(function () {
                showLoadError(
                    "Penyimpanan lokal dihapus tetapi data tidak dapat dimuat ulang dari jaringan."
                );
            });
        });
    }

    function initCv() {
        dismissLoadError();
        setJsonFeedback("", "");
        wireStoragePanel();
        wireMainSectionDelegation();

        var fromLs = readCvFromLocalStorage();
        if (fromLs) {
            appCvData = fromLs;
            renderCv(appCvData);
            return;
        }

        fetchAndPersistCv().fail(function () {
            appCvData = null;
            showLoadError(
                "Tidak dapat memuat data CV (periksa koneksi, cv-data.json di folder yang sama, atau URL di cv.js)."
            );
        });
    }

    $(initCv);
})(jQuery);
