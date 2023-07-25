<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding-Project</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">

    <style>
    
        body{
            display: flex;
            justify-content: center;
            align-content: center;
            height: 100vh;
        }

        .b-styling {
            display:flex; 
            flex-direction:column; 
            justify-content:center; 
            align-items:center; 
            width: 100%;
            margin-top: 10vh;
        }

        h1, h2, h3, h4, h5, h6, p {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .pag-item {
            background-color: black;
            color: white;
            width: 10px;
            height: 10px;
            padding: 3px 10px;
            margin-right: 10px;
            text-decoration: none;
        }

        .pag-item-inactive, .pag-item-next-prev {
            background-color: transparent;
            border: 1px solid grey;
            color: grey;
            width: 10px;
            height: 10px;
            padding: 3px 10px;
            text-decoration: none;
            margin-right: 10px;
        }

        .pag-item-inactive:hover {
            background-color: black;
            color: white;
        }

        .pag-item-next-prev {
            background-color: #d3d3d3;
            border: 1px solid #d3d3d3;
        }

        .pag-item-next-prev:hover {
            color:black;
            background-color: transparent;
            border: 1px solid gray;
        }

        .del-msg {
            width: 66%;
            height: 10vh;
            margin: auto;
            margin-bottom: 20px;
            margin-top: 20px;
            border-radius: 0;
            background-color: #e3c6c6;
            padding: 5px 20px;
            color: #621513;
        }

        .del-success {
            background-color: rgb(197, 238, 136);
            color: rgb(6, 67, 6);
        }

        .input-fn{
            width: 42px;
        }

        .input-ln{
            margin-left: 42px;
        }

        .profile-img {
            width: 100px;
            border-radius: 50%;
        }

        .entry {
            margin-top: 20px;
        }

        .entry input{
            width: 60%;
            height: 25px;
            float: left;
            margin-left: 0;
        }

        .entry button {
            width:30%;
            background-color: black;
            float: right;
            font-size: 12px;
            padding: 7px 5px;
        }

        .logout-btn a{
            color: white; 
            text-decoration:none; 
            font-size: 16px;
            padding: 10px 10px;
            z-index: 6;
        }
        .search-btn {
            padding: 10px;
            background-color: gray;
            border: 1px solid gray;
            border-radius: 0px;
            display: flex;
            justify-content: space-around;
            font-size: medium;
            color: white;
            text-decoration: none;
        }

        .search-message i{
            color:#621513;
        }

        .editor {
            display: none;
        }

        .show-editor {
            margin-top: 20px;
            display: block;
            height: auto;
        }

        .close-editor {
            display: none;
        }
    </style>
</head>
</html>