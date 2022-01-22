<!DOCTYPE html>
<html lang="en">
<head>
    <title>Twid Assessment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 550px}

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {height: auto;}
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-12">
            <div class="well">
                <h4>Pin Code Listing</h4>
            </div>
            <div class="container">
                <table class="table table-bordered" id="example">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Office name</th>
                        <th>Pin Code</th>
                        <th>Office Type</th>
                        <th>Delivery Status</th>
                        <th>Division Name</th>
                        <th>Region Name</th>
                        <th>Circle Name</th>
                        <th>Taluk</th>
                        <th>District Name</th>
                        <th>State Name</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/list',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'officename', name: 'officename' },
                { data: 'pincode', name: 'pincode' },
                { data: 'officeType', name: 'officeType' },
                { data: 'Deliverystatus', name: 'Deliverystatus' },
                { data: 'divisionname', name: 'divisionname' },
                { data: 'regionname', name: 'regionname' },
                { data: 'circlename', name: 'circlename' },
                { data: 'Taluk', name: 'Taluk' },
                { data: 'Districtname', name: 'Districtname' },
                { data: 'statename', name: 'statename' },
            ]
        });
    });
</script>
</body>
</html>
