<style>
.parent {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(8, 1fr);
    gap: 24px;
    min-height: 70vh;
    padding: 40px 0;
    border-radius: 1.5rem;
}
.settings-tile {
    background: #fff;
    border-radius: 2rem;
    box-shadow: 0 4px 24px 0 rgba(76, 68, 182, 0.10);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 160px;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    border: 2px solid transparent;
}
.settings-tile:hover {
    box-shadow: 0 8px 32px 0 rgba(76, 68, 182, 0.18);
    border-color: #a78bfa;
    transform: translateY(-4px) scale(1.03);
}
.settings-icon {
    font-size: 2.5rem;
    color: #a78bfa;
    margin-bottom: 0.7rem;
}
.settings-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #7c3aed;
    margin-bottom: 0.2rem;
}
.settings-desc {
    font-size: 1rem;
    color: #818cf8;
    text-align: center;
}
@media (max-width: 900px) {
    .parent {
        grid-template-columns: 1fr;
        grid-template-rows: repeat(16, 1fr);
    }
}
</style>
<div class="parent">
    <div class="settings-tile div3 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-bell"></i></span>
        <div class="settings-title">Notificações</div>
        <div class="settings-desc">Configuração para notificações do sistema</div>
    </div>
    <div class="settings-tile div4 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-shield-alt"></i></span>
        <div class="settings-title">Segurança</div>
        <div class="settings-desc">Políticas de senha, autenticação e acesso</div>
    </div>
    <div class="settings-tile div5 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-paint-brush"></i></span>
        <div class="settings-title">Aparência</div>
        <div class="settings-desc">Cores, logo e temas do blog</div>
    </div>
    <div class="settings-tile div6 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-users"></i></span>
        <div class="settings-title">Usuários</div>
        <div class="settings-desc">Gerencie administradores e permissões</div>
    </div>
    <div class="settings-tile div7 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-file-alt"></i></span>
        <div class="settings-title">Posts</div>
        <div class="settings-desc">Configurações de publicação e moderação</div>
    </div>
    <div class="settings-tile div8 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-comments"></i></span>
        <div class="settings-title">Comentários</div>
        <div class="settings-desc">Controle de comentários e filtros</div>
    </div>
    <div class="settings-tile div9 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-database"></i></span>
        <div class="settings-title">Backup</div>
        <div class="settings-desc">Backup e restauração de dados</div>
    </div>
    <div class="settings-tile div10 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-plug"></i></span>
        <div class="settings-title">Integrações</div>
        <div class="settings-desc">APIs, webhooks e serviços externos</div>
    </div>
    <div class="settings-tile div11 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-envelope"></i></span>
        <div class="settings-title">Email</div>
        <div class="settings-desc">Configuração de envio de emails</div>
    </div>
    <div class="settings-tile div12 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-globe"></i></span>
        <div class="settings-title">Domínio</div>
        <div class="settings-desc">Gerencie domínios e URLs do blog</div>
    </div>
    <div class="settings-tile div13 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-language"></i></span>
        <div class="settings-title">Idioma</div>
        <div class="settings-desc">Selecione o idioma padrão do sistema</div>
    </div>
    <div class="settings-tile div14 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-cogs"></i></span>
        <div class="settings-title">Avançado</div>
        <div class="settings-desc">Configurações avançadas do sistema</div>
    </div>
    <div class="settings-tile div15 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-chart-line"></i></span>
        <div class="settings-title">Analytics</div>
        <div class="settings-desc">Monitoramento e estatísticas do blog</div>
    </div>
    <div class="settings-tile div16 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-mobile-alt"></i></span>
        <div class="settings-title">Mobile</div>
        <div class="settings-desc">Ajustes para dispositivos móveis</div>
    </div>
    <div class="settings-tile div17 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-bug"></i></span>
        <div class="settings-title">Logs & Erros</div>
        <div class="settings-desc">Visualize e gerencie logs do sistema</div>
    </div>
    <div class="settings-tile div18 unavailable-navbar">
        <span class="settings-icon"><i class="fas fa-info-circle"></i></span>
        <div class="settings-title">Sobre</div>
        <div class="settings-desc">Informações sobre o sistema</div>
    </div>
</div> 