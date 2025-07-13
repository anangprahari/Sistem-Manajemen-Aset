<!-- Footer Fixed -->
<footer class="footer footer-transparent d-print-none fixed-footer">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        <a href="#" target="_blank" class="link-secondary" rel="noopener">
                        TIM 9 OYE
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; <script>document.write(new Date().getFullYear())</script>
                        <a href="#" class="link-secondary">SIADEKOM</a>.
                        All rights reserved.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<style>
/* CSS untuk Footer Fixed */
.fixed-footer {
    position: fixed;
    bottom: 0;
    left: 200px; /* Sesuaikan dengan lebar sidebar */
    right: 0;
    background-color: #ffffff;
    border-top: 1px solid #ddd;
    padding: 1rem;
    z-index: 1020;
    box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
    .fixed-footer {
        left: 0;
    }
}

/* Tambahkan padding-bottom pada body agar konten tidak tertutup footer */
body {
    padding-bottom: 80px;
}
</style>