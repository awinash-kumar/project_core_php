<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Project</title>
</head>
<body>
   <form id="myForm">
  <label for="fatherName">Father's Name:</label>
  <input type="text" id="fatherName" name="fatherName"><br><br>
  
  <label for="motherName">Mother's Name:</label>
  <input type="text" id="motherName" name="motherName"><br><br>
  
  <label for="childName">Child's Name:</label>
  <input type="text" id="childName" name="childName"><br><br>
  
  <label for="childImage">Child's Image:</label>
  <input type="file" id="childImage" name="childImage"><br><br>
  
  <input type="button" value="Submit" onclick="submitForm()">
</form>
<div id="message"></div>
<script>
   function submitForm() {
  var fatherName = document.getElementById("fatherName").value;
  var motherName = document.getElementById("motherName").value;
  var childName = document.getElementById("childName").value;
  var childImage = document.getElementById("childImage").files[0];

  var formData = new FormData();
  formData.append("fatherName", fatherName);
  formData.append("motherName", motherName);
  formData.append("childName", childName);
  formData.append("childImage", childImage);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "process.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("message").innerHTML = xhr.responseText;
      // window.location.href = '/project';
    }
  };
  xhr.send(formData);
}

</script>
</body>
</html>