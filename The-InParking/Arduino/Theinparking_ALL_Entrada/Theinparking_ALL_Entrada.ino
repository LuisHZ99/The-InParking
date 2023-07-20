#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ESP32_Servo.h>

// Definición de pines para el lector RFID
#define SS_PIN 5
#define RST_PIN 27

// Creación de objeto MFRC522 para interactuar con el lector RFID
MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;

// Variables para almacenar los datos de lectura y escritura
int blockNum = 6;
byte blockData[16] = {"HERNANDEZ"};
byte bufferLen = 18;
byte readBlockData[18];
String tag;

int boton = 13; // Número de pin del botón

// Variable para el estado de la operación del lector RFID
MFRC522::StatusCode status;

// Configuración de la conexión Wi-Fi
//const char* ssid = "LabITP";
//const char* password = "Advanced12345#";

const char* ssid = "INFINITUMFE50";
const char* password = "6QVWYxe4ny";

// Creación de objeto Servo para controlar el servo motor
Servo ioe;

// Pines para el sensor ultrasónico, LEDs y servo motor
int trig = 2;
int echo = 21;
int tiempo;
int distancia;
int verde = 16;
int rojo = 17;

void setup() {
  Serial.begin(115200);
  SPI.begin();
  
  // Inicialización del lector RFID
  rfid.PCD_Init();
  Serial.println("Scan a MIFARE 1K Tag to write data...");

  // Conexión a la red Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  // Configuración de pines
  pinMode(trig, OUTPUT);
  pinMode(echo, INPUT);
  ioe.attach(4);
  pinMode(verde, OUTPUT);
  pinMode(rojo, OUTPUT);

  pinMode(boton, INPUT_PULLUP);
}

void loop() {

    // Verificar si el botón pulsador es presionado
  if (digitalRead(boton) == LOW) {
    // Código a ejecutar cuando se presiona el botón
    digitalWrite(verde, HIGH);
    ioe.write(180);

     // Esperar mientras el sensor ultrasónico detecta movimiento
    while (DetectMotion()) {
      // Espera mientras el sensor detecta movimiento
    }
    
    delay(5000);
    digitalWrite(verde, LOW);
    ioe.write(0);
    return;
  }

  // Configuración de la clave del lector RFID
  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

  // Verificar si hay una tarjeta presente en el lector RFID
  if (!rfid.PICC_IsNewCardPresent()) {
    return;
  }
  
  // Leer el ID de la tarjeta
  if (!rfid.PICC_ReadCardSerial()) {
    return;
  }

  Serial.print("\n");
  Serial.println("TAG Detectado:");

  // Leer el ID de la tarjeta y almacenarlo en la variable "tag"
  Serial.print(F("TAG ID: "));
  for (int i = 0; i < rfid.uid.size; i++) {
    tag += rfid.uid.uidByte[i];
  }

  Serial.println(tag);
  tag = "";

  // Leer el dato del bloque 4 de la tarjeta
  ReadDataFromBlock(4, readBlockData);

  Serial.print("\n");
  Serial.print("No. Control: ");
  for (int j = 0 ; j < 16 ; j++) {
    Serial.write(readBlockData[j]);
  }
  Serial.println("\n");

  // Enviar el dato leído a través de la API y obtener la respuesta
  bool response = SendDataToAPI(readBlockData);

  // Detener la tarjeta RFID y realizar acciones según la respuesta recibida
  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();

  if (!response) {
    // Si la respuesta es falsa, encender el LED rojo durante 3 segundos
    digitalWrite(rojo, HIGH);
    delay(3000);
    digitalWrite(rojo, LOW);
  } else {
    // Si la respuesta es verdadera, encender el LED verde y girar el servo motor
    digitalWrite(verde, HIGH);
    ioe.write(180);
    
    // Esperar mientras el sensor ultrasónico detecta movimiento
    while (DetectMotion()) {
      // Espera mientras el sensor detecta movimiento
    }

    delay(5000);
    
    // Apagar el LED verde y volver a la posición inicial del servo motor
    digitalWrite(verde, LOW);
    ioe.write(0);
  }
}

void ReadDataFromBlock(int blockNum, byte readBlockData[]) {
  // Autenticar el bloque de datos para permitir la lectura
  MFRC522::StatusCode status = rfid.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, blockNum, &key, &(rfid.uid));

  if (status != MFRC522::STATUS_OK) {
    Serial.print("Authentication failed for Read: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }

  // Leer los datos del bloque especificado
  status = rfid.MIFARE_Read(blockNum, readBlockData, &bufferLen);
  if (status != MFRC522::STATUS_OK) {
    Serial.print("Reading failed: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }
}

bool SendDataToAPI(byte* readBlockData) {
  // Construir la URL con el número de control obtenido
  String url = "https://nandbless99.shop/theinparking/backend/setStatusAlumnoEntradaCard.php?codigo_nc_ea=";
  for (int j = 0; j < 16; j++) {
    url += char(readBlockData[j]);
  }
  
  // Realizar la solicitud HTTP GET a través de la URL
  HTTPClient http;
  http.begin(url);
  
  int httpResponseCode = http.GET();
  
  // Verificar la respuesta del servidor
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println("API response: " + response);
    return response == "true"?true:false;
  } else {
    Serial.print("Error in HTTP request: ");
    Serial.println(httpResponseCode);
    return false;
  }
  
  http.end();
}

bool DetectMotion() {
  // Enviar un pulso al sensor ultrasónico y medir la distancia
  digitalWrite(trig, HIGH);
  delay(500);
  digitalWrite(trig, LOW);
  tiempo = pulseIn(echo, HIGH);
  distancia = tiempo / 58.2;
  delay(500);

  // Devolver verdadero si la distancia es menor o igual a 20 cm
  return distancia <= 20;
}