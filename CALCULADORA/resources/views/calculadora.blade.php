<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculadora</title>
<style>
    body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f3f4f6; }
        .calculator { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 400px; }
        .top-section { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; }
        .input-group { display: flex; flex-direction: column; width: 30%; }
        input[type="number"], .result-box { width: 100%; padding: 10px; font-size: 18px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .result-box { background-color: #e5e7eb; min-height: 43px; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .symbol { font-size: 24px; padding-bottom: 5px; }
        .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        button { padding: 15px; font-size: 18px; cursor: pointer; border: 1px solid #ccc; background-color: #f9fafb; border-radius: 5px; transition: 0.2s; }
        button:hover { background-color: #e5e7eb; }
        .btn-clear { background-color: #fee2e2; color: #b91c1c; text-decoration: none; display: flex; justify-content: center; align-items: center; border: 1px solid #fca5a5; border-radius: 5px; font-size: 18px;}
        .btn-clear:hover { background-color: #fecaca; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
</style>
</head>
<body>
    

</body>
</html>