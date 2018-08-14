 
function b_edit_row(nomor){
        window.open(M_VIEW+nomor,'_self');
}

function b_del_row(nomor){
    if(confirm('Apakah Anda yakin ingin menghapus baris ini ?'))
        window.open(M_DELETE+nomor,'_self');
}
function b_refresh(){
     
     nRow=$('#txtRows').val();
     nGo=$('#txtGo').val();   
     n=$('#divBFilter').find('input').length;
     param='?';             
     for(i=0;i<n;i++){
         nTag=$('#divBFilter').find('input').eq(i).attr('tag');
         nVal=$('#divBFilter').find('input').eq(i).val();
         if(nVal!=''){
            param=param+'&'+nTag+'='+nVal;
         }
     }
     window.open(M_BROWSE+nGo+'/'+nRow+'/'+param,'_self');
}
function b_clear(){
     n=$('#divBFilter').find('input').length;
     for(i=0;i<n;i++){
        $('#divBFilter').find('input').eq(i).val('');
     }
}
function b_prev(){
    nGo=$('#txtGo').val();
    if(nGo>0)$('#txtGo').val(--nGo);
    b_refresh();
}
function b_next(){
    nGo=$('#txtGo').val();
    $('#txtGo').val(++nGo);    
    b_refresh();
}
function b_filter(){
    $('#divBFilter').toggle();
}
           