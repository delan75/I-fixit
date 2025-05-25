"""
ASGI config for i_fixit project.
"""

import os

from django.core.asgi import get_asgi_application

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'i_fixit.settings')

application = get_asgi_application()
