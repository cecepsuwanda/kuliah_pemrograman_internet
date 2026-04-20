// Mengambil Referensi Elemen berdasarkan ID DOM (Document Object Model)
const judulEl = document.getElementById("judul");
const kotakEl = document.getElementById("kotak1");
const divBaru = document.getElementById("container-baru");

// Referensi Tombol
const btnJudul = document.getElementById("btnUbahText");
const btnWarna = document.getElementById("btnUbahWarna");
const btnTambah = document.getElementById("btnTambahElemen");

// Event Listener: Manipulasi Teks (innerHTML / textContent)
btnJudul.addEventListener("click", function() {
    judulEl.textContent = "Judul Telah Diubah via JS!";
    judulEl.style.color = "blue";
});

// Event Listener: Manipulasi Class (classList)
btnWarna.addEventListener("click", function() {
    // toggle akan menambah class jika belum ada, dan menghapus jika sudah ada
    kotakEl.classList.toggle("highlight");
    
    // Mengecek state box
    if(kotakEl.classList.contains("highlight")) {
        kotakEl.textContent = "On Focus!";
    } else {
        kotakEl.textContent = "Kotak Target";
    }
});

// Event Listener: Menambah Elemen Baru (createElement & appendChild)
let hitung = 1;
btnTambah.addEventListener("click", function() {
    // 1. Buat elemen baru
    const pBaru = document.createElement("p");
    
    // 2. Isi konten elemen
    pBaru.textContent = "Ini adalah paragraf dinamis ke-" + hitung;
    pBaru.style.fontStyle = "italic";
    
    // 3. Masukkan ke dalam DOM (append)
    divBaru.appendChild(pBaru);
    
    hitung++;
});
