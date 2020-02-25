document.querySelector('#uploadButton').addEventListener('click', function(){
    document.querySelector('#uploadFormContainer').style.display = 'block';
    let textbox = document.getElementById('docmentToUpload');
    textbox.focus();
    textbox.scrollIntoView();
    textbox.click()
});
document.querySelector('#closeUploadForm').addEventListener('click', function(){
    document.querySelector('#uploadFormContainer').style.display = 'none';
});


