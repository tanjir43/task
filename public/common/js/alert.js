function showConfirmAlert(title, subtitle) {
	return Swal.fire({
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			title: title,
			text: subtitle,
			icon: 'warning',
			width: '300px',
			customClass: {
				confirmButton: 'btn geo-primary',
				cancelButton: 'btn btn-danger',
				title: 'swal-title',
				content: 'swal-subtitle'
			}
		});
}

function showSuccessAlert(title, subtitle, type='swl') {
    if (type == "toastr") {
        toastr.success(subtitle, title);
    } else if (type=='toastr_bottom') {
        toastr.success(subtitle, title, {"positionClass": "toast-bottom-right",});
    } else {
        Swal.fire({
            confirmButtonText: 'OKAY',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            title: title,
            html: subtitle,
            icon: 'success',
            width: '300px',
            customClass: {
                confirmButton: 'btn geo-primary swal-okay-button',
                title: 'swal-title',
                content: 'swal-subtitle'
            }
        });
    }
}

function showErrorAlert(title, subtitle, type='swl') {
    if (type == "toastr") {
        toastr.error(subtitle, title);
    } else if (type=='toastr_bottom') {
        toastr.error(subtitle, title, {"positionClass": "toast-bottom-right",});
    } else {
        Swal.fire({
            confirmButtonText: 'OKAY',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            title: title,
            html: subtitle,
            icon: 'error',
            width: '300px',
            customClass: {
                confirmButton: 'btn btn-danger swal-okay-button',
                title: 'swal-title',
                content: 'swal-subtitle'
            }
        });
    }
}

function showInfoAlert(title, subtitle, type='swl') {
    if (type == "toastr") {
        toastr.info(subtitle, title);
    } else if (type=='toastr_bottom') {
        toastr.info(subtitle, title, {"positionClass": "toast-bottom-right",});
    } else {
        Swal.fire({
            confirmButtonText: 'OKAY',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            title: title,
            html: subtitle,
            icon: 'info',
            width: '300px',
            customClass: {
                confirmButton: 'btn swal-okay-button',
                title: 'swal-title',
                content: 'swal-subtitle'
            }
        });
    }
}

function showWarningAlert(title, subtitle) {
	Swal.fire({
		confirmButtonText: 'OKAY',
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
		title: title,
		html: subtitle,
		icon: 'warning',
		width: '300px',
		customClass: {
			confirmButton: 'btn btn-warn swal-okay-button',
			title: 'swal-title',
			content: 'swal-subtitle'
		}
	});
}

function showLoader(title, subtitle) {
	Swal.fire({
		// confirmButtonText: 'OKAY',
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
		title: title,
		html: subtitle,
		width: '300px',
		onBeforeOpen: () => {

		}
	});
    Swal.showLoading ();
}

function showHttpErrorAlert(err) {
	if (err.status == 0) {
		showErrorAlert('Error', 'Check your internet connection and try again');
	} else {
		showErrorAlert(err.statusText, err.responseJSON.message);
	}
}

function showModal(title, subtitle) {
	Swal.fire({
		showConfirmButton: false,
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
		title: title,
		html: subtitle,
		width: '350px',
		customClass: {
			title: 'swal-title',
			content: 'swal-subtitle'
		}
	});
}

    function deletePermission(locationHref) {
        Swal.fire({
                title: '',
                html: 'Are you sure to delete this?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = locationHref;
                } else if (result.isDenied) {

                }
            })
    }
