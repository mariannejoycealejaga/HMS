<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "index.php");
}

require_once '../../helpers/custom_field_helper.php';
?>
<style type="text/css">
    .table_print {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .table_print > thead > tr > th,
    .table_print > tbody > tr > th,
    .table_print > tfoot > tr > th,
    .table_print > thead > tr > td,
    .table_print > tbody > tr > td,
    .table_print > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        /*border-top: 1px solid #ddd;*/
    }

    .table_print > thead > tr > th {
        vertical-align: bottom;
        /*border-bottom: 2px solid #ddd;*/
    }

    .table_print > caption + thead > tr:first-child > th,
    .table_print > colgroup + thead > tr:first-child > th,
    .table_print > thead:first-child > tr:first-child > th,
    .table_print > caption + thead > tr:first-child > td,
    .table_print > colgroup + thead > tr:first-child > td,
    .table_print > thead:first-child > tr:first-child > td {
        border-top: 0;
    }

    .table_print > tbody + tbody {
        /*border-top: 2px solid #ddd;*/
    }

    .table_print .table_print {
        background-color: #fff;
    }

    .search_panel {
        margin-bottom: 5px;
    }

    .Search_date {
        font-size: 15px;
        height: 34px;
        width: 160px;
    }

    .Search_partylist {
        font-size: 15px;
        height: 34px;
        width: 160px;
    }

    .Search_partylist > option {
        padding: 6px;
        color: #000;
    }

    #feature {
        margin: 0px 20px;
    }
</style>
<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="col-md-12">
            <form action="index.php?view=attendance" method="POST">
                <div class="row">
                    <button class="btn btn-primary" type="button" onclick="printDiv('employees_report');">Print</button>
                    <div class="search_panel pull-right">
                        <label for="employee">Employee:</label>
                        <select name="employee" id="employee" class="form-control show-tick">
                            <option value="all" selected>ALL</option>
                            <?php
                            $mydb->setQuery("SELECT EmployeeID, concat(Lastname,', ',Firstname,' ',Middlename) AS `name` FROM tblemployee;");
                            $employees = $mydb->loadResultList();
                            foreach ($employees as $employee) {
                                echo "<option value='$employee->EmployeeID'> $employee->name</option>";
                            }
                            ?>
                        </select>
                        <label for="date_from">From:</label>
                        <input size="11" type="date" name="date_from" id="date_from"/>
                        <label for="to_date">To:</label>
                        <input size="11" type="date" name="date_to" id="date_to"/>
                        <button class="btn btn-default" type="submit" name="search_attendance" id="search_attendance"><i
                                class="fa fa-go">GO</i>
                        </button>
                    </div>
                </div>

                <div id="employees_report">
                    <div class="center wow fadeInDown">
                        <h2 class="page-header">Attendance Report</h2>
                        <p class="lead"> <?= $_SERVER['REQUEST_METHOD'] == 'POST' ? 'Report from ' . view_date($_POST['date_from'], 'date') . ' to ' . view_date($_POST['date_to'], 'date') : ''; ?>
                    </div>
                    <div id="error_msg" align="center"></div>

                    <div class="row">
                        <div class="features">
                            <?php

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                # code...
                                ?>
                                <table id="" class="table table-striped table-bordered table-hover "
                                       style="font-size:12px"
                                       cellspacing="0">

                                    <thead>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="2">
                                            <center>AM</center>
                                        </th>
                                        <th colspan="2">
                                            <center>PM</center>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        <th width="150px">Time-In</th>
                                        <th width="150px">Time-Out</th>
                                        <th width="150px">Time-In</th>
                                        <th width="150px">Time-Out</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //                                @$attenddate = date_format(date_create($_POST['attenddate']), 'Y-m-d');
                                    @$employee_id = $_POST['employee'];
                                    @$employee_selected = $_POST['employee'] == "all" ? "" : "AND a.EmployeeID = $employee_id";
                                    @$date_from = date_format(date_create($_POST['date_from']), 'Y-m-d');
                                    @$date_to = date_format(date_create($_POST['date_to']), 'Y-m-d');

                                    $mydb->setQuery("SELECT * FROM tbltimetable a INNER JOIN tblemployee b ON a.EmployeeID = b.EmployeeID WHERE a.AttendDate >= '$date_from' AND a.AttendDate <= '$date_to' $employee_selected ORDER BY a.AttendDate DESC, a.TimeOutAM DESC, TimeOutPM DESC");

                                    $cur = $mydb->loadResultList();

                                    foreach ($cur as $result) {
                                        echo '<tr>';
                                        echo '<td>' . $result->Firstname . ',' . $result->Lastname . ' ' . $result->Middlename . '</td>';
                                        echo '<td>' . date_format(date_create($result->AttendDate), 'M. d, Y') . '</td>';
                                        echo '<td>' . get_text_field($result->TimeInAM) . '</td>';
                                        echo '<td>' . get_text_field($result->TimeOutAM) . '</td>';
                                        echo '<td>' . get_text_field($result->TimeInPM) . '</td>';
                                        echo '<td>' . get_text_field($result->TimeOutPM) . '</td>';

                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>

                                </table>

                            <?php } else {
                                echo "<h2 class='center'>No Record</h2>";
                            } ?>
                        </div><!--/.services-->
                    </div><!--/.row-->
                </div>
            </form>
        </div>
    </div><!--/.container-->
</section><!--/#feature-->

<div class="container">
    <div class="row">
        <form action="attendance_print.php" method="POST" target="_blank">
            <input type="hidden" name="Attendance"
                   value="<?php echo isset($_POST['Attendance']) ? $_POST['Attendance'] : ''; ?>">
            <input type="hidden" name="attenddate"
                   value="<?php echo isset($_POST['attenddate']) ? $_POST['attenddate'] : ''; ?>">
            <input type="hidden" name="EmployeeStatus"
                   value="<?php echo isset($_POST['EmployeeStatus']) ? $_POST['EmployeeStatus'] : ''; ?>">
            <!--            <button class="btn btn-primary" target="_blank" href="">Print</button>-->
        </form>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>