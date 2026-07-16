src/
├── Controller/               <-- Ponto de entrada da sua API
│   ├── Api/
│   │   ├── UserController.php
│   │   ├── ProjectController.php
│   │   └── ComplianceController.php
│
├── Domain/                   <-- O coração do seu sistema
│   │
│   ├── User/                 <-- Tudo sobre Usuários fica aqui
│   │   ├── Entity/User.php
│   │   ├── Enum/UserRole.php
│   │   ├── Repository/UserRepository.php
│   │   └── Service/UserRegistrationService.php
│   │
│   ├── Project/              <-- Tudo sobre Projetos e Tarefas
│   │   ├── Entity/Project.php
│   │   ├── Entity/Task.php
│   │   ├── Enum/ProjectStatus.php
│   │   ├── Repository/ProjectRepository.php
│   │   └── Service/TaskAssignmentService.php
│   │
│   └── Compliance/           <-- O motor de regras e auditoria
│       ├── Entity/ComplianceTemplate.php
│       ├── Entity/ComplianceRequirement.php
│       ├── Entity/TaskCompliance.php
│       ├── Repository/TaskComplianceRepository.php
│       └── Service/ComplianceValidationService.php
│
└── Shared/                   <-- Coisas genéricas usadas por todos
├── Entity/AuditLog.php   <-- O log de auditoria é global
├── Service/AuditLogger.php
└── Exception/DefaultException.php
