<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $titulo?></title>
    <!-- Bootstrap CSS (for structure only) -->
    <link
      href="assets/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Custom Ya estoy en esta wea!!!!! -->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!-- Font Awesome for icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="assets/DataTables/datatables.css"
    />
    <script>
      const htmlElement = document.documentElement;

      const savedTheme = localStorage.getItem("theme");
      if (
        savedTheme === "dark" ||
        (!savedTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)
      ) {
        htmlElement.classList.add("dark");
      }
    </script>
    <script defer src="assets/js/jquery.min.js"></script>
    <script defer src="assets/js/main.js"></script>
    <script defer src="assets/js/utils.js"></script>
    <script defer src="assets/DataTables/datatables.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>