<style>
    .container {
        margin: 0.5%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 60%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .value-button {
        display: inline-block;
        border: 1px solid #ddd;
        margin: 0px;
        width: 40px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
        padding: 11px 0;
        background: #eee;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .value-button:hover {
        cursor: pointer;
    }

    input[type=number] {
        text-align: center;
        border: none;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin: 0px;
        width: 40px;
        height: 40px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .row {
        display: flex;
    }

    /* Create two equal columns that sits next to each other */
    .column {
        flex: 33%;
        /* Should be removed. Only for demonstration */
    }

    span.price {
        margin-left: 2%;
        color: grey;
    }

    input[type=text] {
        margin-bottom: 2px;
        padding: 4px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 30%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }
</style>
