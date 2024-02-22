using System;
using System.Diagnostics;
using System.Diagnostics.Tracing;
using System.Security;

class Program
{
    public static void Main()
    {
        // Créer une nouvelle instance de journal d'événements
        EventLog eventLog = new EventLog();

        // Configurer la source de l'événement
        eventLog.Source = "Application";

        // Enregistrer un événement avec des informations spécifiques
        eventLog.WriteEntry(
            message: "Ceci est un événement d'information généré à des fins de démonstration.",
            type: EventLogEntryType.Information,
            9990,
            0); ;

        // Fermer le journal d'événements
        eventLog.Close();
    }
}