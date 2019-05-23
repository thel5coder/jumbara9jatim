
function containerHeight() {

}

function showSuccessAlert(message,routeUrl) {
	Swal.fire({
		title: 'Berhasil',
		text: message,
		type: 'success',
		showCancelButton: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'OK'
	}).then((result) => {
		if (result.value) {
			if(typeof  routeUrl=='undefined'){
				window.location.reload()
			}else{
				window.location = routeUrl
			}

		}
	})
}

function showDeleteConfirmation(id, title, message, routeUrl, token) {
	Swal.fire({
		title: title,
		text: message,
		type: 'success',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya!'
	}).then((result) => {
		if(result.value){
			$.ajax({
				url:routeUrl,
				method:"POST",
				data:{
					_token:token
				},
				error(xhr,text,errorThrown){
					let errorMessage,index
					index = 0
					errorMessage = ''

					xhr.responseJSON.errorMessage.forEach(function (message) {
						if(index > 0){
							errorMessage +=''+message+','
						}else{
							errorMessage +=''+message
						}
						index+1
					})

					Swal.fire(
						'Error',
						errorMessage,
						'error'
					)
				},
				success(){
					showSuccessAlert('Data berhasil di hapus')
				}
			})
		}
	})
}

function ajaxErrorMessage(errorMessageResponse) {
	let errorMessage,index
	index = 0
	errorMessage = ''

	errorMessageResponse.forEach(function (message) {
		if(index > 0){
			errorMessage +=''+message+','
		}else{
			errorMessage +=''+message
		}
		index+1
	})

	Swal.fire(
		'Error',
		errorMessage,
		'error'
	)
}

function generateSlug(string) {
	slug = string.toLowerCase()
	slug = slug.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"")
	slug = slug.replace(/\s+/g, "-")

	return slug
}

function showLoading(element,effect,text) {

	$(element).waitMe({
		effect : effect,
		text : text,
		color : '#00000',
		textPos : 'vertical'
	});
}