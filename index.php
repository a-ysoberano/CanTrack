<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CanTrack | Supplier Order &amp; Delivery Tracking</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/landing.css">
</head>

<body>
    <header class="site-header">
        <a class="site-brand" href="#home">
            <img class="brand-mark" src="assets/img/logo.png" alt="CanTrack">
            <span>CanTrack<small>Order &amp; Delivery Tracking</small></span>
        </a>
        <nav>
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#workflow">How it works</a>
            <a href="#contact">Contact</a>
        </nav>
        <a class="open-button" href="login.php">Open system</a>
    </header>

    <main id="home">
        <section class="hero">
            <div class="hero-text">
                <h1>Keep every supplier order and delivery on one record, not a stack of slips.</h1>
                <p class="lead">Canteen staff spend their mornings chasing paper: which order went out, what actually arrived, what's running low. CanTrack replaces the stack with one shared record everyone can check.</p>
                <div class="hero-actions">
                    <a class="button primary" href="login.php">Open system</a>
                    <a class="button secondary" href="#workflow">See how it works</a>
                </div>
            </div>
            <div class="hero-strip" aria-hidden="true">
                <div class="strip-cell">
                    <span class="strip-label">Order</span>
                    <span class="strip-value">No. 0247</span>
                </div>
                <div class="strip-cell">
                    <span class="strip-label">Items</span>
                    <span class="strip-value">3 ordered</span>
                </div>
                <div class="strip-cell">
                    <span class="strip-label">Total</span>
                    <span class="strip-value">₱6,420.00</span>
                </div>
                <div class="strip-cell strip-stamp">
                    <span class="strip-label">Status</span>
                    <span class="strip-value stamp">Delivered</span>
                </div>
            </div>
        </section>

        <section id="about" class="section">
            <div class="ledger-spread">
                <div class="page">
                    <span class="folio">P. 01</span>
                    <h2>Built around how the canteen already works.</h2>
                    <p>Nothing about placing an order or checking a delivery changes. You still write down what you need, send it to the supplier, and check the boxes when they arrive. CanTrack just keeps that trail in one place, so nobody has to remember which drawer the slip is in.</p>
                </div>
                <div class="gutter" aria-hidden="true"></div>
                <div class="page">
                    <span class="folio">P. 02</span>
                    <dl class="before-after">
                        <div class="is-before">
                            <dt>Before</dt>
                            <dd>Order slips passed around by hand. Deliveries checked off on scrap paper. Stock counts kept from memory.</dd>
                        </div>
                        <div class="is-now">
                            <dt>Now</dt>
                            <dd>Every order, delivery, and stock count lives in one record that any staff member can open and check.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section id="features" class="section">
            <div class="section-intro">
                <h2>What it keeps track of.</h2>
            </div>
            <ul class="ledger">
                <li>
                    <span class="line-no">01</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M8 4h8a2 2 0 0 1 2 2v13l-3-2-3 2-3-2-3 2V6a2 2 0 0 1 2-2Z" />
                        <path d="M9 8h6M9 12h6" />
                    </svg>
                    <div>
                        <h3>Supplier records</h3>
                        <p>Names, contact numbers, and what each supplier carries, kept in one list instead of scattered business cards.</p>
                    </div>
                </li>
                <li>
                    <span class="line-no">02</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M6 3h9l3 3v15H6z" />
                        <path d="M9 3v4h6V3" />
                        <path d="M9 12h6M9 15h6" />
                    </svg>
                    <div>
                        <h3>Supplier orders</h3>
                        <p>Write up what you're ordering and from whom, with quantities and prices, and the running total works itself out.</p>
                    </div>
                </li>
                <li>
                    <span class="line-no">03</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M3 7h11v9H3z" />
                        <path d="M14 10h4l3 3v3h-7z" />
                        <circle cx="7" cy="18" r="1.6" />
                        <circle cx="17.5" cy="18" r="1.6" />
                    </svg>
                    <div>
                        <h3>Delivery tracking</h3>
                        <p>Mark what actually showed up against what was ordered, so a short delivery gets flagged instead of forgotten.</p>
                    </div>
                </li>
                <li>
                    <span class="line-no">04</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M3 8 12 4l9 4-9 4-9-4Z" />
                        <path d="M3 8v8l9 4 9-4V8" />
                        <path d="M12 12v8" />
                    </svg>
                    <div>
                        <h3>Simple inventory</h3>
                        <p>Received goods add to stock automatically, and items running low stand out before they run out.</p>
                    </div>
                </li>
                <li>
                    <span class="line-no">05</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path d="M6 3h12v18l-3-2-3 2-3-2-3 2Z" />
                        <path d="M9 8h6M9 11h6M9 14h4" />
                    </svg>
                    <div>
                        <h3>Order documents</h3>
                        <p>Turn any order into a message you can send to a supplier, or a printed copy for the canteen files.</p>
                    </div>
                </li>
            </ul>
        </section>

        <section id="workflow" class="section workflow">
            <div class="section-intro">
                <h2>From order to shelf.</h2>
            </div>
            <ol class="receipt-strip">
                <li><b>1</b>Create the order</li>
                <li><b>2</b>Send or print it</li>
                <li><b>3</b>Track the delivery</li>
                <li><b>4</b>Record what arrived</li>
                <li><b>5</b>Stock updates itself</li>
            </ol>
        </section>

        <section class="cta">
            <span class="cta-rule" aria-hidden="true"></span>
            <h2>Start your next order in CanTrack, not on a scrap of paper.</h2>
            <p>Open CanTrack and give your next supplier order a home it won't get lost from.</p>
            <a class="stamp-button" href="login.php">Open system</a>
        </section>
    </main>

    <footer id="contact">
        <div>
            <b><img class="brand-mark" src="assets/img/logo.png" alt="">CanTrack</b>
            <p>A shared record for supplier orders, deliveries, and stock.</p>
        </div>
        <p>&copy; <?= date('Y') ?> CanTrack — Supplier Order &amp; Delivery Tracking System</p>
    </footer>
</body>

</html>