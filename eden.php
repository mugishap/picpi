<?php
include_once("connect1.php");
$query = mysqli_query($connect,"select districtName,sectorName,cellName, count(villageName)as NumberofVillages from villages
join cells using(cellId) join sectors using (sectorId) join districts using(districtId) group by cellName;
")
?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
<script src="pagination.js"></script>

<body>
    <h2>PHP & MySQL</h2>
    <div class="row">
        <table id="example" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Province</th>
                    <th>Districts</th>
                    <th>Sector</th>
                    <th>CellId</th>
                    <th>Cell</th>
                    <th>NUmberofVillage</th>
                </tr>
            </thead>
        </table>
    </div>
    <div style="margin:50px 0px 0px 0px;">
        <a class="btn btn-default read-more" style="background:#3399ff;color:white" href="https://www.phpzag.com/datatable-pagination-using-php-mysql" title="">Back to Tutorial</a>
    </div>
    </div>
</body>

</html>


<script>
    jQuery(document).ready(function() {
        var table = jQuery('#example').dataTable({
            "bProcessing": true,
            "sAjaxSource": "pagination_data.php",
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 6,
            "bLengthChange": false,
            "bFilter": false,
            "aoColumns": [{
                    mData: 'Province'
                },
                {
                    mData: 'District'
                },
                {
                    mData: 'Sector'
                },
                {
                    mData: 'CellId'
                },
                {
                    mData: 'Cell'
                },
                {
                    mData: 'NumberofVillages'
                },
            ]
        });
    });
</script>