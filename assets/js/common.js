
function showToast(title, message, type) {
	$.toast({
    heading: title,
    text: message,
    icon: type,
    position: 'top-right'
  })
}