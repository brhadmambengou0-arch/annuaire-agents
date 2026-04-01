<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANINF — {{ $title ?? 'Annuaire des Agents' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --aninf-blue:       #0ea5e9;
            --aninf-blue-dark:  #0284c7;
            --aninf-blue-deep:  #0369a1;
            --aninf-blue-light: #e0f2fe;
            --aninf-blue-pale:  #f0f9ff;
            --aninf-white:      #ffffff;
            --aninf-slate:      #64748b;
            --aninf-text:       #0f172a;
        }
        * { font-family: 'DM Sans', sans-serif; }
        h1,h2,h3,h4,h5 { font-family: 'Sora', sans-serif; }

        body {
            background: var(--aninf-blue-pale);
            color: var(--aninf-text);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, var(--aninf-blue-deep) 0%, var(--aninf-blue-dark) 60%, var(--aninf-blue) 100%);
            box-shadow: 0 4px 24px rgba(3,105,161,0.18);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: -0.02em;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }
        .navbar-brand .logo-badge {
            background: rgba(255,255,255,0.18);
            border: 1.5px solid rgba(255,255,255,0.35);
            border-radius: 10px;
            padding: 5px 11px;
            font-size: 0.95rem;
            letter-spacing: 0.06em;
        }
        .navbar-brand .logo-sub {
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            font-size: 0.72rem;
            opacity: 0.75;
            display: block;
            letter-spacing: 0.03em;
            line-height: 1;
        }
        .nav-link-custom {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            font-size: 0.88rem;
            padding: 0.45rem 0.9rem !important;
            border-radius: 8px;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background: rgba(255,255,255,0.15);
            color: white !important;
        }

        /* USER BADGE */
        .user-badge {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 10px;
            padding: 6px 14px;
            color: white;
            font-size: 0.84rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .user-avatar {
            width: 28px;
            height: 28px;
            background: var(--aninf-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: white;
            border: 1.5px solid rgba(255,255,255,0.4);
        }
        .role-badge {
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            padding: 1px 7px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* SIDEBAR */
        .sidebar {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(14,165,233,0.08);
            border: 1px solid var(--aninf-blue-light);
            overflow: hidden;
        }
        .sidebar-header {
            background: linear-gradient(135deg, var(--aninf-blue-deep), var(--aninf-blue));
            padding: 1rem 1.2rem;
            color: white;
        }
        .sidebar-header h6 {
            font-family: 'Sora', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            opacity: 0.9;
            margin: 0;
        }
        .tree-node {
            border-left: 2px solid var(--aninf-blue-light);
            margin-left: 1rem;
            padding-left: 0.8rem;
        }
        .tree-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--aninf-slate);
            cursor: pointer;
            transition: all 0.18s;
            width: 100%;
            text-align: left;
            border: none;
            background: transparent;
        }
        .tree-btn:hover { background: var(--aninf-blue-light); color: var(--aninf-blue-dark); }
        .tree-btn.active { background: var(--aninf-blue-light); color: var(--aninf-blue-deep); font-weight: 600; }
        .tree-icon { font-size: 0.75rem; transition: transform 0.2s; }
        .tree-icon.open { transform: rotate(90deg); }
        .dir-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--aninf-blue);
            flex-shrink: 0;
        }
        .svc-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--aninf-blue-light);
            border: 1.5px solid var(--aninf-blue);
            flex-shrink: 0;
        }
        .dept-dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: var(--aninf-slate);
            flex-shrink: 0;
        }

        /* CARDS AGENTS */
        .agent-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--aninf-blue-light);
            overflow: hidden;
            transition: all 0.22s ease;
            cursor: pointer;
            position: relative;
        }
        .agent-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(14,165,233,0.15);
            border-color: var(--aninf-blue);
        }
        .agent-card-header {
            background: linear-gradient(135deg, var(--aninf-blue-pale) 0%, var(--aninf-blue-light) 100%);
            padding: 1.2rem 1.2rem 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }
        .agent-photo {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--aninf-blue-dark), var(--aninf-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(14,165,233,0.3);
        }
        .agent-photo img {
            width: 100%; height: 100%;
            border-radius: 12px;
            object-fit: cover;
        }
        .agent-name {
            font-family: 'Sora', sans-serif;
            font-weight: 600;
            font-size: 0.92rem;
            color: var(--aninf-text);
            line-height: 1.25;
        }
        .agent-matricule {
            font-size: 0.72rem;
            color: var(--aninf-blue-dark);
            font-weight: 500;
            letter-spacing: 0.04em;
            background: rgba(14,165,233,0.1);
            padding: 1px 7px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 2px;
        }
        .agent-card-body { padding: 0.9rem 1.2rem 1rem; }
        .agent-info-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--aninf-slate);
            margin-bottom: 0.35rem;
        }
        .agent-info-row svg { flex-shrink: 0; color: var(--aninf-blue); }
        .agent-info-row a { color: var(--aninf-blue-dark); text-decoration: none; }
        .agent-info-row a:hover { text-decoration: underline; }
        .fonction-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: var(--aninf-blue-pale);
            border: 1px solid var(--aninf-blue-light);
            color: var(--aninf-blue-deep);
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 0.74rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }
        .entity-tag {
            font-size: 0.72rem;
            color: var(--aninf-slate);
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 2px 8px;
            display: inline-block;
            margin-top: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }
        .agent-status-dot {
            position: absolute;
            top: 10px; right: 10px;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 2px white;
        }

        /* SEARCH BAR */
        .search-container {
            background: white;
            border-radius: 14px;
            padding: 1.2rem 1.5rem;
            border: 1px solid var(--aninf-blue-light);
            box-shadow: 0 2px 12px rgba(14,165,233,0.06);
            margin-bottom: 1.5rem;
        }
        .search-input-wrap {
            position: relative;
            flex: 1;
        }
        .search-input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--aninf-blue);
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.6rem;
            border: 1.5px solid var(--aninf-blue-light);
            border-radius: 9px;
            font-size: 0.88rem;
            background: var(--aninf-blue-pale);
            color: var(--aninf-text);
            transition: all 0.2s;
            outline: none;
        }
        .search-input:focus {
            border-color: var(--aninf-blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
        }
        .filter-select {
            padding: 0.6rem 1rem;
            border: 1.5px solid var(--aninf-blue-light);
            border-radius: 9px;
            font-size: 0.85rem;
            background: var(--aninf-blue-pale);
            color: var(--aninf-text);
            min-width: 170px;
            outline: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .filter-select:focus {
            border-color: var(--aninf-blue);
            box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
        }

        /* BUTTONS */
        .btn-primary {
            background: linear-gradient(135deg, var(--aninf-blue-dark), var(--aninf-blue));
            color: white;
            border: none;
            padding: 0.6rem 1.3rem;
            border-radius: 9px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
            box-shadow: 0 3px 12px rgba(14,165,233,0.25);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 18px rgba(14,165,233,0.35);
            color: white;
        }
        .btn-ghost {
            background: transparent;
            color: var(--aninf-slate);
            border: 1.5px solid #e2e8f0;
            padding: 0.6rem 1.1rem;
            border-radius: 9px;
            font-weight: 500;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-ghost:hover { border-color: var(--aninf-blue); color: var(--aninf-blue-dark); }
        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 0.45rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .btn-danger:hover { background: #fecaca; }
        .btn-warning {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
            padding: 0.45rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-warning:hover { background: #fde68a; }

        /* MODAL */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(15,23,42,0.45);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            animation: fadeIn 0.18s ease;
        }
        .modal-box {
            background: white;
            border-radius: 18px;
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 64px rgba(3,105,161,0.18);
            animation: slideUp 0.22s ease;
        }
        .modal-header {
            background: linear-gradient(135deg, var(--aninf-blue-deep), var(--aninf-blue));
            padding: 1.3rem 1.6rem;
            border-radius: 18px 18px 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-header h5 {
            font-family: 'Sora', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            margin: 0;
        }
        .modal-close {
            background: rgba(255,255,255,0.15);
            border: none;
            color: white;
            width: 30px; height: 30px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: background 0.2s;
        }
        .modal-close:hover { background: rgba(255,255,255,0.25); }
        .modal-body { padding: 1.5rem 1.6rem; }
        .modal-footer {
            padding: 1rem 1.6rem 1.4rem;
            display: flex;
            gap: 0.8rem;
            justify-content: flex-end;
            border-top: 1px solid #f1f5f9;
        }

        /* FORM */
        .form-group { margin-bottom: 1.1rem; }
        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--aninf-text);
            margin-bottom: 0.35rem;
            letter-spacing: 0.01em;
        }
        .form-label span { color: #ef4444; margin-left: 2px; }
        .form-control {
            width: 100%;
            padding: 0.6rem 0.9rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            font-size: 0.87rem;
            color: var(--aninf-text);
            background: #fafbfc;
            transition: all 0.2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--aninf-blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.1);
        }
        .form-control.error { border-color: #ef4444; }
        .form-error { color: #ef4444; font-size: 0.76rem; margin-top: 4px; display: block; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* STATS */
        .stat-card {
            background: white;
            border-radius: 13px;
            border: 1px solid var(--aninf-blue-light);
            padding: 1rem 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }
        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 11px;
            background: var(--aninf-blue-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--aninf-blue-dark);
            flex-shrink: 0;
        }
        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--aninf-text);
            line-height: 1;
        }
        .stat-label { font-size: 0.76rem; color: var(--aninf-slate); margin-top: 2px; }

        /* TOAST */
        .toast-container {
            position: fixed;
            top: 80px; right: 1.5rem;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .toast {
            background: white;
            border-radius: 12px;
            padding: 0.85rem 1.2rem;
            box-shadow: 0 8px 30px rgba(14,165,233,0.18);
            border-left: 4px solid var(--aninf-blue);
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 0.85rem;
            font-weight: 500;
            animation: slideInRight 0.25s ease;
            max-width: 340px;
        }
        .toast.success { border-color: #22c55e; }
        .toast.error { border-color: #ef4444; }

        /* PAGINATION */
        .pagination-wrap nav { display: flex; justify-content: center; }

        /* MAIN LAYOUT */
        .main-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem 1.5rem;
        }

        /* PAGE HEADER */
        .page-header {
            background: linear-gradient(135deg, var(--aninf-blue-deep) 0%, var(--aninf-blue) 100%);
            padding: 2rem 1.5rem 1.5rem;
        }
        .page-header-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .page-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }
        .page-subtitle {
            font-size: 0.84rem;
            color: rgba(255,255,255,0.7);
            margin-top: 3px;
        }
        .breadcrumb-aninf {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.65);
            margin-top: 0.5rem;
        }
        .breadcrumb-aninf a { color: rgba(255,255,255,0.8); text-decoration: none; }
        .breadcrumb-aninf a:hover { color: white; }

        /* ANIMATIONS */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .5; } }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--aninf-slate);
        }
        .empty-state svg { color: var(--aninf-blue-light); margin-bottom: 1rem; }
        .empty-state h5 { font-family: 'Sora', sans-serif; color: var(--aninf-text); margin-bottom: 0.4rem; }

        /* LOADING */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f9ff 25%, #e0f2fe 50%, #f0f9ff 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 8px;
        }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .main-layout { grid-template-columns: 1fr; }
            .sidebar-col { display: none; }
            .sidebar-col.show { display: block; }
        }
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .page-title { font-size: 1.2rem; }
            .stats-row { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .agent-card-header { flex-direction: column; align-items: flex-start; }
            .stats-row { grid-template-columns: 1fr; }
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--aninf-blue-pale); }
        ::-webkit-scrollbar-thumb { background: var(--aninf-blue-light); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--aninf-blue); }

        /* ADMIN TABLE */
        .aninf-table { width: 100%; border-collapse: collapse; }
        .aninf-table th {
            background: var(--aninf-blue-pale);
            color: var(--aninf-blue-deep);
            font-family: 'Sora', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 2px solid var(--aninf-blue-light);
        }
        .aninf-table td {
            padding: 0.8rem 1rem;
            font-size: 0.85rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .aninf-table tr:hover td { background: var(--aninf-blue-pale); }
        .table-wrap {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--aninf-blue-light);
            overflow: hidden;
        }

        /* SECTION CARD */
        .section-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--aninf-blue-light);
            overflow: hidden;
        }
        .section-card-header {
            padding: 1rem 1.4rem;
            border-bottom: 1px solid var(--aninf-blue-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .section-card-header h5 {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--aninf-text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-card-body { padding: 1.2rem 1.4rem; }

        /* DROPDOWN MENU */
        .dropdown-menu-aninf {
            background: white;
            border: 1px solid var(--aninf-blue-light);
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(14,165,233,0.12);
            padding: 0.4rem;
            min-width: 180px;
        }
        .dropdown-item-aninf {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.8rem;
            border-radius: 8px;
            font-size: 0.84rem;
            color: var(--aninf-text);
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }
        .dropdown-item-aninf:hover { background: var(--aninf-blue-pale); color: var(--aninf-blue-dark); }
        .dropdown-item-aninf.danger { color: #dc2626; }
        .dropdown-item-aninf.danger:hover { background: #fee2e2; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar px-4" style="padding-top:0.7rem;padding-bottom:0.7rem;">
        <div style="max-width:1400px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">

            {{-- Logo ANINF --}}
            <a href="{{ route('annuaire.index') }}" class="navbar-brand">
                <span class="logo-badge">ANINF</span>
                <span>
                    Annuaire Numérique
                    <span class="logo-sub">Agence Nationale de l'Infrastructure Numérique et des Fréquences</span>
                </span>
            </a>

            {{-- Navigation --}}
            <div style="display:flex;align-items:center;gap:0.3rem;flex-wrap:wrap;">
                <a href="{{ route('annuaire.index') }}"
                   class="nav-link-custom {{ request()->routeIs('annuaire.*') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    Annuaire
                </a>

                @if(auth()->user()?->role === 'admin')
                <a href="{{ route('admin.entities') }}"
                   class="nav-link-custom {{ request()->routeIs('admin.entities') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Structures
                </a>
                <a href="{{ route('admin.fonctions') }}"
                   class="nav-link-custom {{ request()->routeIs('admin.fonctions') ? 'active' : '' }}">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Fonctions
                </a>
                @endif
            </div>

            {{-- User --}}
            @auth
            <div x-data="{ open: false }" style="position:relative;">
                <button @click="open=!open" class="user-badge" style="border:none;cursor:pointer;">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div style="text-align:left;">
                        <div style="font-size:0.82rem;font-weight:600;">{{ auth()->user()->name }}</div>
                        <span class="role-badge">{{ auth()->user()->role ?? 'consultant' }}</span>
                    </div>
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </button>
                <div x-show="open" x-transition @click.outside="open=false"
                     class="dropdown-menu-aninf"
                     style="position:absolute;right:0;top:calc(100% + 8px);z-index:300;">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item-aninf">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        Mon profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item-aninf danger" style="width:100%;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    {{-- TOASTS --}}
    @if(session('success'))
    <div class="toast-container" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
        <div class="toast success">
            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="toast-container" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
        <div class="toast error">
            <svg width="18" height="18" fill="none" stroke="#ef4444" stroke-width="2.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- CONTENU --}}
    @yield('content')

    @livewireScripts
</body>
</html>