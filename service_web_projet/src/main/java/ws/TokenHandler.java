package ws;

import jakarta.xml.soap.SOAPElement;
import jakarta.xml.soap.SOAPEnvelope;
import jakarta.xml.soap.SOAPException;
import jakarta.xml.soap.SOAPHeader;
import jakarta.xml.soap.SOAPMessage;
import jakarta.xml.ws.handler.MessageContext;
import jakarta.xml.ws.handler.soap.SOAPHandler;
import jakarta.xml.ws.handler.soap.SOAPMessageContext;

import javax.xml.namespace.QName;
import java.util.Iterator;
import java.util.Set;

public class TokenHandler implements SOAPHandler<SOAPMessageContext> {

    @Override
    public boolean handleMessage(SOAPMessageContext context) {
        Boolean outboundProperty = (Boolean) context.get(MessageContext.MESSAGE_OUTBOUND_PROPERTY);

        // Handle inbound message
        if (!outboundProperty) {
            SOAPMessage soapMsg = context.getMessage();
            SOAPEnvelope envelope;
            try {
                envelope = soapMsg.getSOAPPart().getEnvelope();
                SOAPHeader header = envelope.getHeader();
                if (header == null) {
                    throw new RuntimeException("No SOAP header.");
                }

                // Extract token and userId from SOAP header
                String token = null;
                Long userId = null;
                Iterator<?> it = header.extractAllHeaderElements();
                while (it.hasNext()) {
                    SOAPElement element = (SOAPElement) it.next();
                    QName qname = element.getElementQName();
                    if (qname.getLocalPart().equals("token")) {
                        token = element.getValue();
                    } else if (qname.getLocalPart().equals("userId")) {
                        userId = Long.valueOf(element.getValue());
                    }
                }

                if (token == null || userId == null) {
                    throw new RuntimeException("Invalid token or userId in SOAP header.");
                }

                // Validate token
                UserServiceImpl userService = new UserServiceImpl();
                if (!userService.isTokenValid(userId, token)) {
                    throw new RuntimeException("Invalid token.");
                }

            } catch (SOAPException e) {
                e.printStackTrace();
            }
        }

        // Continue other handler chain
        return true;
    }

    @Override
    public boolean handleFault(SOAPMessageContext context) {
        return true;
    }

    @Override
    public void close(MessageContext context) {
    }

    @Override
    public Set<QName> getHeaders() {
        return null;
    }
}
