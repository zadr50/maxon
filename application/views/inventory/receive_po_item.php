
<h1>DAFTAR BARANG PO</h1>
<h3></h3>

                    
<table class="table1">
<thead><tr><th>#</th><th>Item No</th><th>Description</th><th>Pesan</th>
<th>Unit</th><th>Sudah</th><th>Sisa</th><th>Terima</th></tr>
</thead>
<tbody>
    <?php
    $i=1;
    foreach($po_item->result() as $row){
        $bal=($row->quantity)-($row->qty_recvd==null?0:$row->qty_recvd);
        echo "<tr>
            <td>".$i++."</td>
            <td>".$row->item_number."</td>
            <td>".$row->description."</td>
            <td>".$row->quantity."</td>
            <td>".$row->unit."</td>
            <td>".($row->qty_recvd==null?0:$row->qty_recvd)."</td>
            <td>".$bal."</td>            
            <td><input type='text' name='qty[]' value='".$bal."'>
            <input type='hidden' name='line_number[]' value='".$row->line_number."'>
            </td>
        </tr>";
    }
    ?>
</tbody>
</table>