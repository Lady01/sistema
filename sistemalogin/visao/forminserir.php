<html>
<head>
<title>Cadastro de Usuário</title>
</head>
<body>
<h3>Cadastro de Usuário</h3>
<form id="form_cadastro_usuario" action="../controle/verificaAcao.php?controlador=ControleUsuario&acao=inserir" method="post">
<input type="hidden" name="controlador" value="ControleUsuario"/>
<input type="hidden" name="acao" value="inserir"/>
<select name="nivelUsuario" id="nivelUsuario">
	<option value="">Selecione o nivel de usuario</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
</select>
<br/>
<label>Nome de Usuario: <input type="text" name="nomeUsuario"/></label>
<br/>
<label>Senha: <input type="password" name="senhaUsuario"/></label><br/>
<input type="submit" name="enviar" value="Enviar"/>
</form>
</body>
</html>