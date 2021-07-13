<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>

    <!-- Define Charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- Responsive Meta Tag -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

    <title>{!! @$title !!}</title><!-- Responsive Styles and Valid Styles -->

    <style type="text/css">

        body{
            width: 100%;
            background-color: #fff;
            margin:0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;
        }

        p,h1,h2,h3,h4{
            margin-top:0;
            margin-bottom:0;
            padding-top:0;
            padding-bottom:0;
        }
        .content{
            padding: 30px;
        }

        span.preheader{display: none; font-size: 1px;}

        html{
            width: 100%;
        }

        table{
            border: 0;
            width: 100%;
        }

        /* ----------- responsivity ----------- */
        @media only screen and (max-width: 640px){
            /*------ top header ------ */
            body[yahoo] .show{display: block !important;}
            body[yahoo] .hide{display: none !important;}

            /*----- main image -------*/
            body[yahoo] .main-image img{width: 440px !important; height: auto !important;}

            /* ====== divider ====== */
            body[yahoo] .divider img{width: 440px !important;}

            /*--------- banner ----------*/
            body[yahoo] .banner img{width: 440px !important; height: auto !important;}
            /*-------- container --------*/
            body[yahoo] .container590{width: 440px !important;}
            body[yahoo] .container580{width: 400px !important;}
            body[yahoo] .container1{width: 420px !important;}
            body[yahoo] .container2{width: 400px !important;}
            body[yahoo] .container3{width: 380px !important;}

            /*-------- secions ----------*/
            body[yahoo] .section-item{width: 440px !important;}
            body[yahoo] .section-img img{width: 440px !important; height: auto !important;}
        }

        @media only screen and (max-width: 479px){
            /*------ top header ------ */
            body[yahoo] .main-header{font-size: 24px !important;}
            body[yahoo] .resize-text{font-size: 14px !important;}

            /*----- main image -------*/
            body[yahoo] .main-image img{width: 280px !important; height: auto !important;}

            /* ====== divider ====== */
            body[yahoo] .divider img{width: 280px !important;}
            body[yahoo] .align-center{text-align: center !important;}


            /*-------- container --------*/
            body[yahoo] .container590{width: 280px !important;}
            body[yahoo] .container580{width: 250px !important;}
            body[yahoo] .container1{width: 260px !important;}
            body[yahoo] .container2{width: 240px !important;}
            body[yahoo] .container3{width: 220px !important;}

            /*------- CTA -------------*/
            body[yahoo] .cta-button{width: 200px !important;}
            body[yahoo] .cta-text{font-size: 14px !important;}
        }

    </style>
</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div class="content">
    {!! @$details !!}
</div>
</body>
</html>
