<script>
    function saveChanges() {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    function logout() {
        Swal.fire({
            title: 'Do you want leave the application?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isDenied) {
                Swal.fire('Ok, go back to the work', '', 'info')
            }
            if (result.isConfirmed) {
                axios.post('/logout')
                    .then(response => {
                        location.href = '/';
                    })

                    .catch(error => {
                        console.log('errors: ', error)
                    })
            }
        })
    }

    function deleteObject(url, callback, name) {
        Swal.fire({
            title: 'Do you want delete ' + name + '?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(url)
                    .then(response => {
                        location.href = callback;
                    })
                    .catch(error => {
                        console.log('errors: ', error)
                    })
            }
        })
    }
</script>
