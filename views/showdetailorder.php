
<div style="margin:5%;">
        <div style="margin-bottom: 2rem;" class="row justify-content-center align-items-center g-2 mt-10">
            <h1>Chi tiết đơn hàng </h1>
            <a href="/user_order">Trở lại</a>
        </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col"> Order ID</th>
                        <th class="col">Product Id</th>
                        <th class="col">Quantity</th>
                        <th class="col">Price</th>
                 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($model as $value)
                        {
                        ?>
                        <tr>
                            <td><?php echo $value->product_id ?></td>
                            <td><?php echo $value->order_id ?></td>
                            <td><?php echo $value->quantity ?></td>
                            <td><?php echo $value->price ?></td>
                           
                        </tr>
                        <?php
                    }
                    ?>
                    
                    
                    
                </tbody>
            </table>
</div>