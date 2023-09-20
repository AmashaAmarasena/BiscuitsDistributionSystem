
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <?php
    include_once ("header.php");
    ?>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <?php
    include_once ("sidebar.php");
    ?>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header" id="top">
                                <h2 class="pageheader-title">Form Elements </h2>
                                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Form Elements</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="page-section" id="overview">
                        <!-- ============================================================== -->
                        <!-- overview  -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- end overview  -->
                        <!-- ============================================================== -->
                    </div>
                    <!-- ============================================================== -->
                    <!-- basic form  -->
                    <!-- ============================================================== -->
                    <div class="row" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <div class="card" style="background-color: #2e6da4; ">
                                <h3 class="card-header text-center">My form 1</h3>
                                <div class="card-body">
                                    <br><br>
                                    <form style="background-color: whitesmoke">
                                        <br><br>
                                        <div class="form-group row">
                                            <label for="inputText3" class="col-3 col-lg-3 col-form-label text-right">Input Text</label>
                                            <div class="col-8 col-lg-8">
                                            <input id="inputText3" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-right">Email</label>
                                            <div class="col-8 col-lg-8">
                                                <input id="inputEmail2" type="email"  data-parsley-type="email" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="inputText4" class="col-3 col-lg-3 col-form-label text-right">Number</label>
                                            <div class="col-8 col-lg-8">
                                            <input id="inputText4" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <label for="inputText5" class="col-3 col-lg-3 col-form-label text-right">NIC</label>
                                            <div class="col-8 col-lg-8">
                                                <input id="inputText5" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <br>


                                        <div class="form-group row">
                                            <label for="exampleFormControlTextarea1" class="col-3 col-lg-3 col-form-label text-right">Address</label>
                                            <div class="col-8 col-lg-8">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <br><br>

                                        <div class="col-sm-7 col-xl-7 col-lg-7 col-md-7 pl-0">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-success">Submit</button>
                                                <button class="btn btn-space btn-danger">Cancel</button>
                                            </p>
                                        </div>
                                        <br><br>
                                    </form>
                                </div>
                                <div class="card-body border-top hidden" style="visibility: hidden;">
                                    <h3>Sizing</h3>
                                    <form>
                                        <div class="form-group">
                                            <label for="inputSmall" class="col-form-label">Small</label>
                                            <input id="inputSmall" type="text" value=".form-control-sm" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDefault" class="col-form-label">Default</label>
                                            <input id="inputDefault" type="text" value="Default input" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLarge" class="col-form-label">Large</label>
                                            <input id="inputLarge" type="text" value=".form-control-lg" class="form-control form-control-lg">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic form  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- select options  -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end select options  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- checkboxes and radio -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end checkboxes and radio -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- validation state -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end validation state -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- input groups -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end input groups -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- inputmask -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end  inputmask -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- switch component -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end switch component -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- sidenavbar -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- end sidenavbar -->
                <!-- ============================================================== -->
            </div>
        </div>
        <!-- ============================================================== -->

        <!-- footer -->
        <!-- ============================================================== -->


        <!--

<script>
    $(function(e) {
        "use strict";
        $(".date-inputmask").inputmask("dd/mm/yyyy"),
            $(".phone-inputmask").inputmask("(999) 999-9999"),
            $(".international-inputmask").inputmask("+9(999)999-9999"),
            $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
            $(".purchase-inputmask").inputmask("aaaa 9999-****"),
            $(".cc-inputmask").inputmask("9999 9999 9999 9999"),
            $(".ssn-inputmask").inputmask("999-99-9999"),
            $(".isbn-inputmask").inputmask("999-99-999-9999-9"),
            $(".currency-inputmask").inputmask("$9999"),
            $(".percentage-inputmask").inputmask("99%"),
            $(".decimal-inputmask").inputmask({
                alias: "decimal",
                radixPoint: "."
            }),

            $(".email-inputmask").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(n, a) {
                    return (e = e.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })
    });
</script>

-->
        <?php
        include_once ("footer.php");



