
<style>
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #dee0e0;
    text-align: center;
    padding: 10px 20px;
}
.footer p {
    margin: 0;
    color: #6c757d;
}
@media (max-width: 768px) {
            .footer {
                padding: 10px;
            }
            .footer p {
                font-size: 14px;
            }
        }

  /* Media query para tamaños de pantalla de móviles */
  @media (max-width: 480px) {
            .footer {
                padding: 10px;
                background-color: #cfd2d3; /* Color de fondo más oscuro para mejor visibilidad */
            }
            .footer p {
                font-size: 14px;
                color: #50575e; /* Color de texto más oscuro para mejor contraste */
            }
        }
</style>    

<!-- pie de pagina -->
<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} Smartcode Innovation. Todos los derechos reservados.</p>
    </div>
</footer>
