<?php 
namespace Putin;

class WebInterface implements IRunInterface{

    function prepare(){
        $this->header();
    }

    function finish(){
        $this->footer();
    }

    function header(){
        ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUTIN</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>
            html{
                scroll-behavior: smooth;
            }

            @-webkit-keyframes Flux {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @-moz-keyframes Flux {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @keyframes Flux {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }

            .success-tag{
                color: rgb(49, 237, 7);
            }
            .failure-tag{
                color: rgb(255, 25, 0);
            }
            .failure-type-tag{
                color: rgb(255, 145, 0);
            }
            .hero{
                background: linear-gradient(to bottom right, rgba(255, 255, 255, 1), rgba(0, 0, 255, 1), rgba(255, 0, 0, 0.7), rgba(255, 255, 255, 1));
                background-size: 400% 400%;
                color:white;
                border-bottom:  1.5px solid gray;
                -webkit-animation: Flux 20s ease infinite;
                -moz-animation: Flux 20s ease infinite;
                animation: Flux 20s ease infinite;
            }
            .theico{
                filter: invert(100%);
                height: 100px;
            }
            p{
                margin: 0;
            }
            .lead > span{
                font-weight: bold;
            }
            .row:not([header-row]){
                border: 1px solid gray;
                border-radius: 3px;
                margin-bottom: 0.3rem;
                padding: 1rem 0;
            }
            .row[header-row]{
                color:white;
                font-weight: normal;
            }
            body{
                background: rgba(51, 47, 47, 1);
                font-family: Roboto;
            }
            .test-case{
                background: rgb(66, 62, 62);
                padding: 1em 2em;
                border-radius:6px;
            }
            .test-result{
                background: white;
            }
            .test-results h3{
                color:white;
            }
            .case-closure{
                color:white;
            }
            .test-case hr{
                height: 1px;
                background-color: white;
                border: none;
                opacity: 0.9;
            }
            .da-svidanya{
                color:white;
            }
        </style>
    </head>
    <body>
    <div class="px-4 pt-5 pb-5 text-center hero css-selector">
    <svg class="d-block mx-auto theico" version="1.0" xmlns="http://www.w3.org/2000/svg"
        width="200.000000pt" height="200.000000pt" viewBox="0 0 200.000000 200.000000"
        preserveAspectRatio="xMidYMid meet">

        <g transform="translate(0.000000,200.000000) scale(0.100000,-0.100000)"
        fill="#000000" stroke="none">
        <path d="M855 1916 c-151 -35 -282 -111 -384 -222 -103 -113 -180 -299 -181
        -437 0 -32 -5 -49 -15 -53 -8 -3 -17 -14 -20 -24 -7 -23 121 -448 143 -472 8
        -10 23 -18 32 -18 21 0 26 -23 36 -157 l6 -91 104 -120 c138 -160 214 -209
        359 -232 124 -20 274 24 365 106 24 22 83 85 132 141 l89 102 11 121 11 121
        32 14 c23 9 36 23 43 47 93 291 131 431 122 449 -6 10 -14 19 -19 19 -4 0 -11
        33 -14 73 -7 91 -46 213 -94 297 -21 36 -72 99 -113 140 -136 136 -282 199
        -475 206 -71 2 -131 -1 -170 -10z m315 -41 c36 -9 75 -22 88 -29 l24 -13 -32
        -27 c-86 -71 -207 -105 -312 -86 -68 13 -163 58 -198 95 l-21 22 43 18 c115
        46 277 54 408 20z m-425 -104 c84 -64 147 -86 255 -86 107 0 171 21 254 84 53
        41 66 46 85 37 16 -7 51 -66 117 -198 l94 -188 0 -256 c0 -190 -4 -269 -14
        -307 -8 -29 -20 -126 -27 -217 -7 -97 -17 -175 -25 -190 -8 -14 -34 -47 -59
        -75 l-44 -50 34 130 c21 81 30 134 24 140 -16 16 -25 -5 -63 -155 -20 -80 -41
        -155 -46 -167 -15 -37 -126 -111 -197 -133 -94 -29 -111 -27 -115 12 -4 45
        -32 45 -36 1 -4 -40 -21 -42 -115 -13 -66 21 -178 93 -195 127 -5 10 -26 86
        -47 168 -40 155 -48 176 -65 159 -6 -6 3 -55 25 -137 18 -70 32 -127 30 -127
        -1 0 -27 29 -57 64 l-54 63 -13 169 c-7 93 -19 195 -27 227 -10 43 -14 128
        -14 318 l0 259 86 173 c49 98 97 182 112 194 15 13 28 23 30 23 1 0 31 -22 67
        -49z m825 -188 c54 -81 85 -163 101 -276 l12 -78 -49 -117 -49 -117 -5 225 -5
        225 -78 155 -79 155 52 -50 c28 -27 73 -82 100 -122z m-1077 5 l-78 -153 -5
        -215 -5 -215 -43 105 c-23 58 -42 122 -42 142 0 114 60 273 144 385 41 54 90
        103 102 103 2 0 -31 -69 -73 -152z m-120 -588 c41 -103 67 -187 71 -222 6 -57
        -1 -71 -22 -45 -15 17 -141 430 -135 440 10 16 21 -7 86 -173z m1337 168 c0
        -21 -122 -422 -133 -435 -22 -28 -30 -12 -24 48 4 44 25 111 73 230 61 152 84
        194 84 157z"/>
        <path d="M722 1458 c3 -8 51 -19 129 -30 114 -15 135 -15 262 -1 101 12 137
        20 137 29 0 17 -34 17 -162 0 -80 -10 -116 -10 -195 0 -129 17 -176 18 -171 2z"/>
        <path d="M725 1371 c-9 -16 7 -20 138 -36 113 -14 138 -14 249 0 67 8 126 15
        130 15 4 0 8 7 8 15 0 18 -8 18 -151 1 -99 -13 -130 -13 -220 -1 -125 17 -146
        18 -154 6z"/>
        <path d="M725 1280 c-10 -16 30 -26 156 -40 90 -9 138 -10 205 -1 151 19 164
        22 164 37 0 17 0 17 -143 -1 -105 -14 -129 -14 -241 0 -147 18 -133 17 -141 5z"/>
        <path d="M635 1095 c-44 -18 -80 -39 -80 -46 0 -15 6 -15 43 -4 16 5 22 2 22
        -9 0 -22 23 -20 45 4 47 52 152 45 200 -12 59 -70 62 -85 30 -203 -24 -93 -31
        -108 -56 -121 -52 -26 -51 -102 1 -129 16 -8 42 -15 58 -15 15 0 40 -6 55 -12
        22 -11 27 -20 27 -50 0 -27 4 -38 15 -38 11 0 15 11 15 38 0 33 4 39 39 55 20
        9 53 17 73 17 73 0 98 81 39 130 -26 22 -37 45 -62 132 l-29 105 26 46 c31 57
        64 84 111 93 43 8 104 -9 128 -36 23 -25 35 -25 35 0 0 17 3 18 27 9 29 -11
        62 -4 47 11 -5 4 -45 23 -89 40 -73 29 -86 32 -154 25 -133 -11 -125 -6 -147
        -99 l-20 -82 35 -127 c26 -93 40 -127 51 -127 22 0 40 -20 40 -45 0 -24 -18
        -45 -37 -45 -7 0 -13 7 -13 15 0 21 -10 19 -54 -15 -50 -38 -63 -37 -116 1
        -41 30 -44 31 -57 13 -13 -17 -14 -17 -35 3 -20 21 -20 23 -4 47 9 14 23 26
        31 26 13 0 22 22 70 191 15 52 14 61 -4 139 -11 45 -21 84 -23 85 -4 3 -182
        25 -194 24 -5 0 -45 -16 -89 -34z m260 -25 c3 -5 2 -10 -4 -10 -5 0 -13 5 -16
        10 -3 6 -2 10 4 10 5 0 13 -4 16 -10z m225 -5 c-7 -9 -15 -13 -17 -11 -7 7 7
        26 19 26 6 0 6 -6 -2 -15z"/>
        <path d="M684 1037 c-38 -33 -23 -52 19 -27 40 25 76 25 116 3 40 -24 53 -7
        18 23 -39 33 -115 34 -153 1z"/>
        <path d="M1168 1044 c-28 -15 -38 -44 -15 -44 6 0 21 7 31 15 28 21 79 19 109
        -5 37 -29 49 -4 13 27 -32 27 -95 31 -138 7z"/>
        <path d="M750 1010 c0 -5 5 -10 10 -10 6 0 10 5 10 10 0 6 -4 10 -10 10 -5 0
        -10 -4 -10 -10z"/>
        <path d="M1220 1010 c0 -5 7 -10 15 -10 8 0 15 5 15 10 0 6 -7 10 -15 10 -8 0
        -15 -4 -15 -10z"/>
        <path d="M506 933 c-11 -12 -6 -65 10 -99 22 -45 75 -90 124 -105 l39 -12 3
        -105 c2 -73 7 -107 16 -110 9 -3 12 26 12 121 l0 124 -37 7 c-21 3 -52 15 -70
        25 -35 22 -73 86 -73 125 0 25 -12 40 -24 29z"/>
        <path d="M1441 886 c-19 -77 -87 -136 -156 -136 l-25 0 0 -125 c0 -104 2 -125
        15 -125 12 0 15 19 15 109 l0 109 31 6 c75 15 139 85 154 169 6 29 4 37 -8 37
        -9 0 -19 -17 -26 -44z"/>
        <path d="M702 414 c-30 -21 -15 -42 18 -24 16 9 29 9 49 0 23 -9 360 -9 456 0
        11 1 30 -1 43 -5 16 -5 22 -3 22 7 0 23 -44 42 -77 33 -15 -4 -43 -6 -60 -6
        -49 2 -261 3 -313 1 -25 -1 -61 1 -80 5 -25 4 -42 1 -58 -11z"/>
        <path d="M857 363 c-14 -13 -6 -24 26 -38 17 -7 35 -17 39 -21 10 -9 146 -9
        156 0 4 4 22 14 40 21 17 8 32 18 32 24 0 16 -21 24 -33 12 -14 -14 -223 -15
        -232 -1 -7 12 -19 13 -28 3z"/>
        </g>
        </svg>

        <h1 class="display-5 fw-bold">Welcome to PUTIN</h1>
        <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">The <span>P</span>hp <span>U</span>nit <span>T</span>est<span>in</span>g framework that will help you to fix your code<br>and maybe also to get Украина back</p>
        </div>
    </div>
        <div class="container test-results">
    <?php
    }

    function footer(){
        ?>
        </div>
        <div class="da-svidanya px-4 pt-5 pb-5 text-center">
            <p style="font-size:30px">До свидания</p>
            <p>Author: <a style="color:white" target="_blank" href="https://github.com/sadkebab">sadKebab</a></p>
        </div>
        </body>
        </html>
        <?php
    }

    function caseInfo($case){
        $caseClass=get_class($case);
        ?>
        <div class="test-case mt-4">
        <h3 ><?php echo $caseClass ?></h3>
        <hr>
        <div class="row" header-row>
            <div class="col">
                <p>Result</p>
            </div>
            <div class="col">
                <p>Function</p>
            </div>
            <div class="col">
                <p>Message</p>
            </div>
        </div>
        <?php
    }

    static function countSuccess($results){
        $s=0;
        foreach ($results as $result) {
            switch ($result->result) {
                case TestResult::SUCCESS:
                    $s++;
                    break;               
                default:
                    break;
            }
        }
        return $s;
    }

    function caseClosed($case, $results){
        $tot=sizeof($results);
        $success=WebInterface::countSuccess($results);
        $rate=$success * 100 / $tot;
        $rateString=floor($rate)."%";
        ?>
        <p class="case-closure">Success rate: <?php echo $rateString;?></p>
        </div>
        <?php
    }

    function displayResults($results){
        foreach ($results as $result) {
            $this->addRow($result->result, $result->msg, $result->caller);
        }
    }

    static function classForResult($result){
        switch ($result) {
            case TestResult::SUCCESS:
                return "success-tag";
            case TestResult::FAILURE:
                return "failure-tag";
            case TestResult::TYPE_MISMATCH:
                return "failure-type-tag";
            default:
                return "";
        }
        
    }

    function addRow($result, $msg, $caller){
        ?>
        <div class="row test-result">
            <div class="col">
            <p class="<?php echo WebInterface::classForResult($result);?>"><b><?php echo $result;?></b></p>
            </div>
            <div class="col">
                <p><?php echo $caller;?></p>
            </div>
            <div class="col">
                <p><?php echo $msg;?></p>
            </div>
        </div>
        <?php
    }

    
}

