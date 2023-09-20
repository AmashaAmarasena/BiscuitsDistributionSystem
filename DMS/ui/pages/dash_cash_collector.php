<?php
    $invoice_info = $dash_brd_obj->get_last_10_invoices();
?>

<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Last 10 Invoices</h5>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Ref</th>
                            <th>Note</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice_info as $inv) { ?>
                           <tr>
                                <td><?php echo $inv['cus_invoice_id']; ?></td>
                                <td><?php echo $inv['cus_invoice_date']; ?></td>
                                <td><?php echo $inv['cus_invoice_refno']; ?></td>
                                <td><?php echo $inv['cus_invoice_note']; ?></td>
                                <td><?php echo $inv['cus_invoice_type']; ?></td>
                                <td ><?php echo number_format($inv['cus_invoice_total_amount'],2); ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>