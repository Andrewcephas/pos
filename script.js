$(document).ready(function () {
    $('#productForm').on('submit', function (e) {
      e.preventDefault();
  
      let formData = new FormData(this);
  
      $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          alert(response);
          $('#productForm')[0].reset();
        },
        error: function () {
          alert('Error while inserting data.');
        }
      });
    });
  });
  