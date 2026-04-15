
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión detectado</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">
    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
        
        <div style="background:#111827; color:#ffffff; padding:24px; text-align:center;">
            <h1 style="margin:0; font-size:24px;">TicketFast</h1>
            <p style="margin:8px 0 0 0; font-size:14px;">Notificación de seguridad</p>
        </div>

        <div style="padding:32px;">
            <h2 style="margin-top:0; color:#111827;">Hola, {{ $user->name }}</h2>

            <p style="font-size:15px; color:#374151; line-height:1.6;">
                Detectamos un inicio de sesión exitoso en tu cuenta de TicketFast.
            </p>

            <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px; margin:24px 0;">
                <p style="margin:0 0 10px 0; color:#111827;"><strong>Correo:</strong> {{ $user->email }}</p>
                <p style="margin:0 0 10px 0; color:#111827;"><strong>Fecha y hora:</strong> {{ $loginTime }}</p>
                <p style="margin:0 0 10px 0; color:#111827;"><strong>IP:</strong> {{ $ip }}</p>
                <p style="margin:0; color:#111827;"><strong>Dispositivo/Navegador:</strong> {{ $userAgent }}</p>
            </div>

            <p style="font-size:15px; color:#374151; line-height:1.6;">
                Si fuiste tú, no necesitas hacer nada.
                Si no reconoces este acceso, te recomendamos cambiar tu contraseña de inmediato.
            </p>

            <div style="text-align:center; margin:30px 0;">
                <a href="{{ url('/') }}"
                   style="display:inline-block; background:#2563eb; color:#ffffff; text-decoration:none; padding:14px 24px; border-radius:8px; font-weight:bold;">
                    Regresar al sistema
                </a>
            </div>

            <p style="font-size:13px; color:#6b7280; margin-bottom:0;">
                Este es un mensaje automático de TicketFast.
            </p>
        </div>
    </div>
</body>
</html>