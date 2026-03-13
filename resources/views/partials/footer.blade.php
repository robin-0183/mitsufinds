<style>
body.has-footer {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
body.has-footer .page-main {
    flex: 1;
}
.site-footer {
    margin-top: auto;
    padding: 1.75rem 1.5rem 2.25rem;
    background: #000000;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    text-align: center;
}
.site-footer-left {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}
.site-footer-copyright {
    margin-top: 0.5rem;
    font-size: 0.7rem;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #ffffff;
    text-align: center;
}
.site-footer-links {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 1.25rem;
}
.site-footer-links a {
    font-size: 0.75rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #ffffff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    min-height: 44px;
    padding: 0.25rem 0.5rem;
    transition: color 0.2s ease, transform 0.2s ease;
    outline: none;
}
.site-footer-links a:hover {
    color: #e5e7eb;
    transform: scale(1.08);
}
.site-footer-links a:focus {
    color: #ffffff;
    outline: none;
}
.site-footer-disclaimer {
    flex: 1 1 100%;
    text-align: center;
    max-width: 840px;
    font-size: 0.8rem;
    color: #d1d5db;
}
.site-footer-ctas {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
}
.site-footer-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    min-height: 44px;
    background: #0a0a0a;
    color: #ffffff;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 999px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    transition: border-color 0.2s, transform 0.2s;
}
.site-footer-btn:hover {
    border-color: rgba(255, 255, 255, 0.5);
    transform: scale(1.02);
}
.site-footer-btn svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}
@media (max-width: 768px) {
    .site-footer { padding: 1.25rem 1rem 1.75rem; gap: 0.5rem; }
    .site-footer-disclaimer { font-size: 0.75rem; padding: 0 0.5rem; }
    .site-footer-links { flex-wrap: wrap; justify-content: center; gap: 0.75rem; }
    .site-footer-links a { font-size: 0.7rem; }
    .site-footer-copyright { font-size: 0.65rem; margin-top: 0.25rem; }
    .site-footer-btn { padding: 0.4rem 0.75rem; font-size: 0.8rem; }
}
@media (max-width: 480px) {
    .site-footer { padding: 1rem 0.75rem 1.5rem; }
    .site-footer-ctas { flex-direction: column; }
}
</style>
<footer class="site-footer" role="contentinfo">
    <p class="site-footer-disclaimer">
        Please be aware that this website contains affiliate links. This means that if you make a purchase through these links, we may earn a small commission. This commission helps us maintain and improve our website at no extra cost to you.
    </p>
    <div class="site-footer-links">
        <a href="{{ route('dmca-privacy') }}">DMCA Policy</a>
        <a href="{{ route('dmca-privacy') }}">IP Policy</a>
    </div>
    <p class="site-footer-copyright">© {{ date('Y') }} mitsufinds all rights reserved</p>
</footer>
