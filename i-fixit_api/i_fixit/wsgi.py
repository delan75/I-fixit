"""
WSGI config for i_fixit project.
"""

import os

from django.core.wsgi import get_wsgi_application

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'i_fixit.settings')

application = get_wsgi_application()
