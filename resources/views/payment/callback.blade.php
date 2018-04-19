<html>
<body>
<script>
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "{{ $gateway_callback }}");
    form.setAttribute("target", "_self");

    var codeField = document.createElement("input");
    codeField.setAttribute("name", "code");
    codeField.setAttribute("value", "{{$code}}");

    var messageField = document.createElement("input");
    messageField.setAttribute("name", "message");
    messageField.setAttribute("value", "{{$message}}");

    var tracking_codeField = document.createElement("input");
    tracking_codeField.setAttribute("name", "tracking_code");
    tracking_codeField.setAttribute("value", "{{$tracking_code}}");

    var hashField = document.createElement("input");
    hashField.setAttribute("name", "hash");
    hashField.setAttribute("value", "{{$hash}}");

    var gateway_order_idField = document.createElement("input");
    gateway_order_idField.setAttribute("name", "gateway_order_id");
    gateway_order_idField.setAttribute("value", "{{$gateway_order_id}}");

    var gateway_idField = document.createElement("input");
    gateway_idField.setAttribute("name", "gateway_id");
    gateway_idField.setAttribute("value", "{{$gateway_id}}");


    form.appendChild(codeField);
    form.appendChild(messageField);
    form.appendChild(tracking_codeField);
    form.appendChild(hashField);
    form.appendChild(gateway_order_idField);
    form.appendChild(gateway_idField);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
</script>
</body>
</html>