<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->include('admin/layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        // function previewImg() {
        //     //mengambil data dari field input dengan id sampul
        //     const sampul = document.getElementById("sampul");
        //     //mengambil data dari field img dengan class img-preview
        //     const imgPreview = document.getElementById("imgk");

        //     const fileSampul = new FileReader();
        //     fileSampul.readAsDataURL(sampul.file[0]);
        //     fileSampul.onload = function(e) {
        //         imgPreview.src = e.target.result;
        //     }

        // }
        function showPreview(event) {

            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("imgk");
                var sampul = document.getElementById("gambar_sampul");
                var sampulLabel = document.getElementById("labs");
                sampulLabel.textContent = sampul.files[0].name;
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>

</body>

</html>