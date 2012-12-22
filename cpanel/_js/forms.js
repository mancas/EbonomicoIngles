function checkUpload($options) {

    $options = $options || new Array('_name', '_file');

    $result = true;

    for (var i=0;i<$options.length;i++) {
        $result = $result && isEmptyField($options[i]);
    }
    return $result;
}

function isEmptyField($id) {
    $fieldValue = $('#item'+$id).val();
    $result = true;
    if($fieldValue == ""){
        $msg = "<strong>Error:</strong> Este campo no puede estar vacio";
        $('#e'+ $id).html($msg);
        $result = false;
    }else{
        $('#e'+ $id).html("");
    }
    
    return $result;    
}
