// Fungsi untuk konfirmasi Edit
function confirmEdit(event) {
    event.preventDefault(); // Mencegah aksi default (langsung mengarahkan ke route edit)
    const url = event.currentTarget.getAttribute('href'); // Ambil URL dari atribut href

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan mengedit data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Edit!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Lanjutkan ke route edit jika dikonfirmasi
        }
    });
}

// Fungsi untuk konfirmasi Delete
function confirmDelete(event) {
    event.preventDefault(); // Mencegah aksi default (langsung mengarahkan ke route delete)
    const form = event.target.closest('form'); // Ambil form terdekat

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Data berhasil dihapus!',
                'Data telah dihapus.',
                'success'
            )
            form.submit(); // Submit form jika dikonfirmasi
        }
    });
}

function showErrorAlert(title, text) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        confirmButtonText: 'OK'
    });
}

// Fungsi untuk konfirmasi Logout
function confirmLogout() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari sistem!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form logout jika dikonfirmasi
            document.getElementById('logoutForm').submit();
        }
    });
}

// Export fungsi agar bisa digunakan di file lain
export { confirmEdit, confirmDelete, showErrorAlert, confirmLogout };
