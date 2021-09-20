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

    function deleteObject(url, api_token, callback, name) {
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
                axios.delete(url, {headers: {'Authorization' : 'Bearer ' + api_token, 'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
                    .then(response => {
                        location.href = callback;
                    })
                    .catch(error => {
                        console.error('errors: ', error);
                        if ( error.response.data.message ) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: 'error',
                                title: error.response.data.message
                            })
                        }
                    })
            }
        })
    }

    function updateToken(url) {
        axios.post(url, {headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
            .then(response => {
                $("#api_token").val(response.data.token);
            })
            .catch(error => {
                console.error('errors: ', error)
            })
    }
</script>
