const express = require('express');
const { RtcTokenBuilder, RtcRole } = require('agora-access-token');

const app = express();
const port = process.env.PORT || 3000;

app.use(express.json());

const appId = '1J5efcXgg1uCwNZVgsWkeotJKEQAYBujwE';
const appCertificate = 'f962afe32ba04e418e4eb50d99cffb10';

app.post('/generate-token', (req, res) => {
  const { channelName, uid } = req.body;

  const expirationTimeInSeconds = 3600;

  const role = RtcRole.PUBLISHER; 

  const token = RtcTokenBuilder.buildTokenWithUid(
    appId,
    appCertificate,
    channelName,
    uid,
    role,
    expirationTimeInSeconds
  );

  res.json({ token });
});

app.listen(port,() => {
  console.log(`Server is running on port ${port}`);
});
