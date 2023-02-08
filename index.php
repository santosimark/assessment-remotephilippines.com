<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assessment for the Full Stack Developer Candidate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            margin-left: auto;
            margin-right: auto;
            width: 80%;
        }
    </style>
</head>

<body>

    <div class="row mt-5">
        <div class="col-md-8">
            <h1>Assessment for the Full Stack Developer Candidate</h1>
            <p class="fs-5 col-md-12">Write a PHP script that takes an input file containing a list of URLs and outputs the HTTP status code for each URL. </p>

            <div id="liveAlertPlaceholder"></div>

            <div class="mb-3">
                <form method="post" enctype="multipart/form-data" id="formID">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Please upload the URL List (csv)</label>
                        <input class="form-control" type="file" id="file" name="file" accept=".csv" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Check Status</button>
                    </div>
                </form>
            </div>

            <table class="table table-bordered" id="resultTable">
                <thead>
                    <th>URL</th>
                    <th>Status</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            $("#formID").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "upload.php",
                    data: new FormData(this),
                    contentType: false, // The content type used when sending data to the server.  
                    cache: false, // To unable request pages to be cached  
                    processData: false, // To send DOMDocument or non processed data file it is set to false 
                    success: function(data) {
                        JSON.parse(data).forEach(function(value) {
                            $('#resultTable tr:last').after(
                                `<tr>
                                <td>` + value.url + `</td>
                                <td>` + value.status + `</td>
                            </tr>`);
                        });
                    },
                    error: function(data) {
                        $('#liveAlertPlaceholder').html(`<div class="alert alert-danger" role="alert">
                            Please check the uploaded file and try again.
                        </div>`);
                    }
                });
            });
        });
    </script>
</body>

</html>