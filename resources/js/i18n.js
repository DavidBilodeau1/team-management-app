import { createI18n } from 'vue-i18n';

const messages = {
    'fr-CA': {
        app: {
            name: 'Gestion des équipes',
        },
        nav: {
            teams: 'Équipes',
            profile: 'Profil',
            logout: 'Déconnexion',
        },
        auth: {
            login: 'Connexion',
            signIn: 'Se connecter',
            signInToAccount: 'Connectez-vous à votre compte',
            email: 'Adresse courriel',
            password: 'Mot de passe',
            rememberMe: 'Se souvenir de moi',
            forgotPassword: 'Mot de passe oublié?',
        },
        teams: {
            title: 'Équipes',
            description: 'Gérez vos équipes et leurs courtiers.',
            noTeams: 'Aucune équipe trouvée',
            noTeamsDescription: 'Commencez par créer votre première équipe.',
            backToTeams: 'Retour aux équipes',
            deleteTeam: 'Supprimer l\'équipe',
            deleteTeamTitle: 'Supprimer l\'équipe',
            deleteTeamMessage: 'Êtes-vous sûr de vouloir supprimer cette équipe? Tous les courtiers de cette équipe seront également supprimés. Cette action est irréversible.',
            brokerCount: '{count} courtier(s)',
        },
        brokers: {
            title: 'Courtiers',
            addBroker: 'Ajouter un courtier',
            addBrokerDescription: 'Ajouter un nouveau courtier à cette équipe.',
            noBrokers: 'Aucun courtier',
            noBrokersDescription: 'Commencez par ajouter un courtier à cette équipe.',
            name: 'Nom',
            email: 'Courriel',
            enterName: 'Entrez le nom du courtier',
            enterEmail: 'Entrez le courriel du courtier',
        },
        common: {
            cancel: 'Annuler',
            delete: 'Supprimer',
            save: 'Enregistrer',
            add: 'Ajouter',
        },
        toast: {
            brokerCreated: 'Le courtier a été ajouté avec succès.',
            teamDeleted: 'L\'équipe a été supprimée avec succès.',
        },
    },
    'en': {
        app: {
            name: 'Team Management',
        },
        nav: {
            teams: 'Teams',
            profile: 'Profile',
            logout: 'Log Out',
        },
        auth: {
            login: 'Login',
            signIn: 'Sign in',
            signInToAccount: 'Sign in to your account',
            email: 'Email address',
            password: 'Password',
            rememberMe: 'Remember me',
            forgotPassword: 'Forgot password?',
        },
        teams: {
            title: 'Teams',
            description: 'Manage your teams and their brokers.',
            noTeams: 'No teams found',
            noTeamsDescription: 'Get started by creating your first team.',
            backToTeams: 'Back to Teams',
            deleteTeam: 'Delete Team',
            deleteTeamTitle: 'Delete Team',
            deleteTeamMessage: 'Are you sure you want to delete this team? All brokers in this team will also be deleted. This action cannot be undone.',
            brokerCount: '{count} broker(s)',
        },
        brokers: {
            title: 'Brokers',
            addBroker: 'Add Broker',
            addBrokerDescription: 'Add a new broker to this team.',
            noBrokers: 'No brokers',
            noBrokersDescription: 'Get started by adding a broker to this team.',
            name: 'Name',
            email: 'Email',
            enterName: 'Enter broker name',
            enterEmail: 'Enter broker email',
        },
        common: {
            cancel: 'Cancel',
            delete: 'Delete',
            save: 'Save',
            add: 'Add',
        },
        toast: {
            brokerCreated: 'Broker has been added successfully.',
            teamDeleted: 'Team has been deleted successfully.',
        },
    },
};

const savedLocale = typeof localStorage !== 'undefined' ? localStorage.getItem('locale') : null;

const i18n = createI18n({
    legacy: false,
    locale: savedLocale || 'fr-CA',
    fallbackLocale: 'fr-CA',
    messages,
});

export default i18n;

