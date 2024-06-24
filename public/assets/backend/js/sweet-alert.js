// pada halaman update about di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editAboutBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data About Berhasil Di Update',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman edit team di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editTeamBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data Team Berhasil Di Edit',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman tambah gallery di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tambahGalleryBTN').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Foto Berhasil Ditambahkan',
            showConfirmButton: false,
            timer: 1500
        });
    });
});


// pada halaman edit gallery di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tambahGalleryBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data Gallery Berhasil Di Tambahkan',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman edit gallery di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editGalleryBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Foto Berhasil Di Ubah',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman edit member di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editMemberBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data Member Berhasil Di Edit',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman tambah pengguna di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tambahPenggunaBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Pengguna Berhasil Ditambahkan',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman edit pengguna di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editPenggunaBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Data Pengguna Berhasil Di Edit',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman update informasi di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editInformasiBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Informasi Website Berhasil Di Update',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// pada halaman update benefit di dashboard
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editBenefitBtn').addEventListener('click', function () {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Benefit Website Berhasil Di Update',
            showConfirmButton: false,
            timer: 1500
        });
    });
});

// Pada halaman send broadcast email
document.getElementById('sendBroadcast').addEventListener('click', function() {
    // Tampilkan Sweet Alert dengan loading
    Swal.fire({
        title: "Send Broadcasts To All Members",
        html: "Broadcast Is In Progress, Please Wait ...",
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
            // Kirim request ke server untuk proses pengiriman email
            fetch('{{ route("humas.broadcast.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    subject: document.getElementById('subject').value,
                    text: document.getElementById('text').value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Mengatur timer berdasarkan waktu yang diberikan oleh server
                let processTime = data.process_time * 1000; // Waktu proses dalam milidetik

                Swal.fire({
                    icon: 'success',
                    title: 'Broadcast Successful!',
                    timer: processTime,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    willClose: () => {
                        document.getElementById('broadcastForm').submit();
                    }
                });
            })
        }
    });
});
