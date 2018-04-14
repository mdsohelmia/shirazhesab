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



    form.appendChild(codeField);
    form.appendChild(messageField);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
</script>
</body>
</html>