<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $gl_id; $source,$operation,$date
?>

<form id='frmItem'>
    <h1>Pilih kode perkiraan</h1>
    <h3>Silahkan pilih kode atau nama perkiraan dibawah ini</h3>
    <p>Kemudian isi field debit atau credit, anda tidak boleh mengisi kedua field ini apabila 
    salah satunya debit atau kredit sudah diisi.</p>
    <table>
        <?=form_hidden('gl_id',$gl_id,'id=gl_id')?>
        <?=form_hidden('source',$source,'id=source')?>
        <?=form_hidden('operation',$operation,'id=operation')?>
        <?=form_hidden('date',$date,'id=date')?>

        <tr><td>Perkiraan</td><td><?=form_dropdown('account',$account_lookup,'','id=account');?></td></tr>
        <tr><td>Debit</td><td><?=form_input('debit','0','id=debit')?></td></tr>
        <tr><td>Credit</td><td><?=form_input('credit','0','id=credit')?></td></tr>
    </table>
</form>
