from todo_project import app
import logging
from logging.handlers import SysLogHandler

# Configurando o SysLogHandler
try:
    handler = SysLogHandler(address='/dev/log')
    formatter = logging.Formatter('%(asctime)s %(levelname)s: %(message)s')
    handler.setFormatter(formatter)

    # Adicionando o handler ao logger da aplicação
    app.logger.addHandler(handler)
    app.logger.setLevel(logging.INFO)

except Exception as e:
    print(f"Erro ao configurar o syslog: {e}")

# Iniciando o aplicativo Flask
if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0')