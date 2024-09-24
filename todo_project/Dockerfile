# Usar uma imagem base do Python
FROM python:3.8-slim

# Definir o diretório de trabalho dentro do container
WORKDIR /app

# Copiar os arquivos do projeto para o container
COPY . /app

# Instalar as dependências
RUN pip install -r requirements.txt

# Expor a porta 5000 (Flask usa por padrão)
EXPOSE 5000

# Comando para iniciar a aplicação
CMD ["python", "run.py"]