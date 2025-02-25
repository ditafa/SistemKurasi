// Function untuk konfirmasi terima produk
function confirmAccept() {
    Swal.fire({
        title: 'Konfirmasi Terima',
        text: "Apakah Anda yakin ingin menerima produk ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Terima',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add your logic here for accepting the product
            Swal.fire(
                'Berhasil!',
                'Produk telah diterima.',
                'success'
            );
        }
    });
}

// Function untuk revisi dengan catatan
async function revisionWithNote() {
    const { value: revisionText } = await Swal.fire({
        title: 'Catatan Revisi',
        input: 'textarea',
        inputLabel: 'Masukkan catatan revisi',
        inputPlaceholder: 'Tulis catatan revisi di sini...',
        inputAttributes: {
            'aria-label': 'Tulis catatan revisi di sini'
        },
        showCancelButton: true,
        confirmButtonColor: '#EAB308',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal'
    });

    if (revisionText) {
        // Show confirmation dialog
        const result = await Swal.fire({
            title: 'Konfirmasi Revisi',
            text: 'Apakah Anda yakin ingin mengirim revisi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#EAB308',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            // Add your logic here for handling the revision
            // For example: await sendRevision(revisionText);
            Swal.fire(
                'Berhasil!',
                'Catatan revisi telah dikirim.',
                'success'
            );
        }
    }
}

// Function untuk konfirmasi tolak produk
function confirmReject() {
    Swal.fire({
        title: 'Konfirmasi Tolak',
        text: "Apakah Anda yakin ingin menolak produk ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add your logic here for rejecting the product
            Swal.fire(
                'Produk Ditolak',
                'Produk telah berhasil ditolak.',
                'success'
            );
        }
    });
}