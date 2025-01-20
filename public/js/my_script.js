// FORMAT ANGKA
function formatAngka(input) {
  // Menghapus semua karakter selain angka
  let value = input.value.replace(/[^0-9]/g, "");
  // Format angka dengan titik setiap ribuan
  let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  // Menetapkan nilai yang sudah diformat kembali ke input
  input.value = formattedValue;
}

// DATA KODE DAN TAHUN
document.addEventListener("DOMContentLoaded", function () {
  // Mendapatkan semua elemen dengan class 'id_bid' dan 'kd_box'
  const bidangSelects = document.querySelectorAll(".id_bid");
  const kdBoxInputs = document.querySelectorAll(".kd_box");
  const tahunSelects = document.querySelectorAll(".tahun");

  // Menambahkan event listener untuk setiap bidangSelect
  bidangSelects.forEach(function (bidangSelect, index) {
    const kdBoxInput = kdBoxInputs[index];
    const tahunSelect = tahunSelects[index];

    bidangSelect.addEventListener("change", function () {
      const selectedOption = bidangSelect.options[bidangSelect.selectedIndex];
      const kodeValue = selectedOption.getAttribute("data-kode");
      const tahunValue = tahunSelect.options[tahunSelect.selectedIndex].value;
      kdBoxInput.value = tahunValue + (kodeValue ? "/" + kodeValue : "") + "/";
    });

    // Menambahkan listener untuk perubahan tahun
    tahunSelect.addEventListener("change", function () {
      bidangSelect.dispatchEvent(new Event("change"));
    });
  });
});

// MEMBATASI JUMLAH DIGIT
function validateTwoDigits(input) {
  if (input.value.length > 0) {
    input.value = input.value.slice(0, 2); // Memotong input menjadi 2 digit
  }
  // Memastikan nilai berada dalam rentang 10-99
  if (input.value < 1 || input.value > 10) {
    input.value = ""; // Reset nilai jika di luar rentang
  }
}

// MODAL KONFIRMASI HAPUS
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".btn-delete");
  const deleteConfirmButton = document.getElementById("btnDeleteConfirm");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const deleteUrl = "Dokumen/hapus/" + id;
      // Set href pada tombol konfirmasi
      deleteConfirmButton.setAttribute("href", deleteUrl);
      // Tampilkan modal
      const modal = new bootstrap.Modal(document.getElementById("modalDelete"));
      modal.show();
    });
  });
});

$(document).ready(function () {
  // Open Edit Modal and Load Data
  $(".btn-edit").on("click", function () {
    const id = $(this).data("id");
    $.ajax({
      url: "Dokumen/getDokumenById",
      type: "POST",
      data: { id: id },
      dataType: "json",
      success: function (data) {
        if (data) {
          $("#modalEdit #editId").val(data.id);
          $("#modalEdit #editKdRak").val(data.kd_rak);
          $("#modalEdit #kd_box").val(data.kd_box.replace(/\/\d+$/, "/"));
          $("#modalEdit #editNoBox").val(data.no_box);
          $("#modalEdit #editNoSp2d").val(data.no_sp2d);
          $("#modalEdit #editTglSp2d").val(data.tgl_sp2d);
          $("#modalEdit #editNoKontrak").val(data.no_kontrak);
          $("#modalEdit #editNilaiKontrak").val(
            data.nilai_kontrak.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
          );
          $("#modalEdit #editJenisBelanja").val(data.jenis_belanja);
          $("#modalEdit #id_bid").val(data.id_bid).trigger("change");
          $("#modalEdit #id_subkeg").val(data.id_subkeg).trigger("change");
          $("#modalEdit #tahun").val(data.tahun);
          $("#modalEdit #editKet").val(data.ket);
          $("#modalEdit #oldFile").val(data.file);
          $("#modalEdit #oldCreated_at").val(
            data.created_at.replace(" ", "_").replace(/:/g, "-")
          );
          $("#modalEdit").modal("show");
        } else {
          alert("Data Tidak Ditemukan");
        }
      },
      error: function (xhr, status, error) {
        console.error("Status:", status);
        console.error("Error:", error);
        console.log("Response:", xhr.responseText);
        alert("Gagal mengambil data");
      },
    });
  });

  // Update Form Submit
  $("#formEditDokumen").on("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
      url: "Dokumen/update",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        alert("Data successfully updated!");
        location.reload(); // Reload page to reflect changes
      },
      error: function () {
        alert("An error occurred while updating data.");
      },
    });
  });
});

// VALIDASI NIP
function validateNIPAndNoHP() {
  const nipInput = document.getElementById("nip");
  const tglInput = document.getElementById("tgl_pinjam");
  const noHpInput = document.getElementById("no_hp");
  const nipWarning = document.getElementById("nipWarning");
  const tglWarning = document.getElementById("tglWarning");
  const noHpWarning = document.getElementById("noHpWarning");
  const submitBtn = document.getElementById("btnPinjam");
  const form = nipInput.closest("form"); // Mendapatkan elemen form
  const tglPinjamInput = document.getElementById("tgl_pinjam");

  // Validasi saat pengguna mengetik NIP
  nipInput.addEventListener("input", function () {
    let value = this.value.replace(/[^0-9-]/g, ""); // Izinkan hanya angka dan simbol '-'
    this.value = value.substring(0, 18); // Batas maksimal 18 karakter
    nipWarning.textContent = ""; // Hapus peringatan saat pengguna mengetik
  });

  // Validasi saat pengguna mengetik nomor HP
  tglInput.addEventListener("input", function () {
    tglWarning.textContent = ""; // Hapus peringatan saat pengguna mengetik
  });
  // Validasi saat pengguna mengetik nomor HP
  noHpInput.addEventListener("input", function () {
    let value = this.value.replace(/[^0-9]/g, ""); // Hanya izinkan angka
    this.value = value.substring(0, 13); // Batas maksimal 13 karakter
    noHpWarning.textContent = ""; // Hapus peringatan saat pengguna mengetik
  });

  // Validasi saat tombol Submit ditekan
  submitBtn.addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah pengiriman form jika validasi gagal

    const nipValue = nipInput.value.trim();
    const onlyNipDigits = nipValue.replace(/-/g, ""); // Hilangkan simbol '-' dan hitung hanya angka

    const tglValue = tglInput.value.trim();
    const noHpValue = noHpInput.value.trim();
    const onlyNoHpDigits = noHpValue.replace(/[^0-9]/g, ""); // Hilangkan semua karakter non-angka

    // Validasi: NIP tidak boleh kosong
    if (nipValue.length === 0) {
      nipWarning.textContent = "NIP tidak boleh kosong.";
      return;
    }

    if (tglValue.length === 0) {
      tglWarning.textContent = "Tanggal Peminjaman tidak boleh kosong.";
      return;
    }

    // Validasi: Jika hanya simbol '-', valid
    if (/^-+$/.test(nipValue)) {
      // Anggap valid jika hanya karakter '-'
      nipWarning.textContent = ""; // Tidak ada pesan kesalahan
    }
    // Validasi: NIP harus 18 digit angka (jika tidak hanya simbol '-')
    else if (onlyNipDigits.length !== 18) {
      nipWarning.textContent = "NIP harus 18 digit angka.";
      return;
    }

    // Validasi: Nomor HP tidak boleh kosong
    if (noHpValue.length === 0) {
      noHpWarning.textContent = "Nomor HP tidak boleh kosong.";
      return;
    }

    // Validasi: Nomor HP harus hanya angka dan panjangnya harus antara 11 hingga 13 digit
    if (onlyNoHpDigits.length < 11 || onlyNoHpDigits.length > 13) {
      noHpWarning.textContent = "Nomor HP harus antara 11 hingga 13 digit";
      return;
    }

    // Jika semua validasi terpenuhi, kosongkan warning dan lanjutkan
    nipWarning.textContent = "";
    noHpWarning.textContent = "";
    tglWarning.textContent = "";

    // Cek apakah tgl_pinjam valid menggunakan validasi HTML (required)
    if (!tglPinjamInput.checkValidity()) {
      alert("Tanggal Peminjaman harus diisi.");
      return;
    }

    // Kirim form secara eksplisit
    form.submit();
  });
}

// Panggil fungsi validasi
validateNIPAndNoHP();

function showTime() {
  var date = new Date();
  var j = date.getHours(); // 0-23
  var m = date.getMinutes(); // 0-59
  var d = date.getSeconds(); // 0-59
  var session = "AM";

  if (j == 0) {
    j = 12;
  }
  if (j > 12) {
    j = j - 12;
    session = "PM";
  }

  j = j < 10 ? "0" + j : j;
  m = m < 10 ? "0" + m : m;
  d = d < 10 ? "0" + d : d;

  var waktu = j + ":" + m + ":" + d + " " + session;
  document.getElementById("time").innerText = waktu;
  document.getElementById("time").textContent = waktu;

  setTimeout(showTime, 1000);
}
