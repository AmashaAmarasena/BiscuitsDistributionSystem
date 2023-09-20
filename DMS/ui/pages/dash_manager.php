<?php
    $staff_info = $dash_brd_obj->get_last_10_staff();
?>

<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Last Added Staff</h5>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nic</th>
                            <th>Email</th>
                             <th>Phone Number</th>
                             <th>User name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff_info as $stff) { ?>
                           <tr>
                                <td><?php echo $stff['st_name']; ?></td>
                                <td><?php echo $stff['st_nic']; ?></td>
                                <td><?php echo $stff['st_email']; ?></td>
                                <td><?php echo $stff['st_phone']; ?></td>
                                <td><?php echo $stff['st_user_name']; ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>