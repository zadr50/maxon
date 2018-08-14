
<table class='table' cellspacing="0" cellpadding="1" border="1" width='100%'>
    <?php
    $agdg=null;
    if($qgdg=$CI->db->query("select wh_code from po_qty_alloc q 
        inner join purchase_order_lineitems i on i.line_number=q.line_id_po 
        where i.purchase_order_number='$po_number'  and q.qty>0
        group by wh_code order by no_urut")){
            foreach($qgdg->result() as $gdg){
                $agdg[]=$gdg->wh_code;
            }
        }
    echo "<thead>";
    if($agdg){
        $s="";
        echo "<th>Item Distribusi</th>";
        for($i=0;$i<count($agdg);$i++){
            $s.="<th>".$agdg[$i]."</th>";
        }
        echo $s;
        echo "<th>Total</th>";
    }
    
    echo "</thead><tbody>";
    $s="select q.wh_code,q.qty,i.item_number,sum(q.qty) as zqty from po_qty_alloc q 
        inner join purchase_order_lineitems i on i.line_number=q.line_id_po
        where i.purchase_order_number='$po_number' and q.qty>0 
        group by q.wh_code,i.item_number";
    
    
    if($q=$CI->db->query($s)){
            $qgdg=null;
            foreach($q->result() as $row){
                for($ii=0;$ii<count($agdg);$ii++){
                    if($row->wh_code==$agdg[$ii]){
                        $qgdg[$row->item_number][$row->wh_code]=$row->zqty;                    
                    }
                }
            }            
            echo "<tr>";
            if($qgdg){
                while ($gdg = current($qgdg)) {
                    echo "<td>".key($qgdg)."</td>";
                    $total=0;      
                              
                    for($i=0;$i<count($agdg);$i++){
                        $qty=0;
                        $g=$agdg[$i];
                        if(isset($gdg[$g])){
                            $qty=$gdg[$g];    
                            
                        }
                        $total+=$qty;
                        echo "<td align='center'>$qty</td>";
                    }
                    echo "<td align='center'>$total</td></tr>";
                    
                    next($qgdg);
                }
            }
        }
     echo "</tbody>";
    ?>
    
</table>            