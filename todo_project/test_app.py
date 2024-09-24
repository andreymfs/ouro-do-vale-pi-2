import pytest
from todo_project import app

@pytest.fixture
def client():
    with app.test_client() as client:
        yield client

def test_home(client):
    """Testa a página inicial"""
    rv = client.get('/')
    assert rv.status_code == 200
