<!DOCTYPE html>
<html>
<head>
    <title>Mailchimp PHP API Signup Form Tutorial</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Mailchimp PHP API Signup Form Tutorial</h1>

    <form id="subscribe-form" method="post">
        <div class="subscribe-feedback"></div>

        <div class="form-group">
            <label>First Name</label>
            <input class="form-control" name="first_name">
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input class="form-control" name="email_address">
        </div>

        <div class="form-group">
            <button class="btn btn-success subscribe-submit" type="submit">Subscribe</button>
        </div>
    </form>
</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $('#subscribe-form').submit(function() {
        $('.subscribe-submit').prop('disabled', true);

        $.ajax({
            url: '/newsletter/subscribe',
            method: 'POST',
            data: {
                first_name: $('input[name=first_name]').val(),
                email_address: $('input[name=email_address]').val()
            },
            dataType: 'json'
        })
            .done(function(data) {
                    $('.subscribe-feedback').html(
                        '<div class="alert alert-warning">' + data.message + '</div>'
                    );
                    $('input[name=first_name]').val('');
                    $('input[name=email_address]').val('');
            })
            .fail(function() {
                $('.subscribe-feedback').html(
                    '<div class="alert alert-warning">There was a problem subscribing, please try again.</div>'
                );
            })
            .always(function() {
                $('.subscribe-submit').prop('disabled', false);
            });

        return false;
    });
</script>
</body>
</html>