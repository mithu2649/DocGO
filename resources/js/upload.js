document.querySelector('#uploadButton').addEventListener('click', function () {
    let form = document.querySelector('#uploadFormContainer');
    form.style.display = 'block';
    let textbox = document.getElementById('docmentToUpload');

    // textbox.scrollIntoView();
    textbox.click()
    // form.scrollIntoView();

});
document.querySelector('#closeUploadForm').addEventListener('click', function () {
    document.querySelector('#uploadFormContainer').style.display = 'none';
});


